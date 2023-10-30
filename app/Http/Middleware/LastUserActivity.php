<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTAuth;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if($token) {
            try {
                $user = app(JWTAuth::class)->parseToken()->authenticate();
            } catch (\Exception $exception) {
                return response()->json($exception->getMessage(), 401);
            }

            if ($user) {
                if (Cache::has('user-is-online-' . $user->id) === false) {
                    $expiresAt = Carbon::now()->addMinutes(1); // keep online for 1 min
                    Cache::put('user-is-online-' . $user->id, true, $expiresAt);
                    // last seen
                    User::where('id', $user->id)->update(['last_seen_at' => (new \DateTime())->format("Y-m-d H:i:s")]);
                }
            }
        }

        return $next($request);
    }
}
