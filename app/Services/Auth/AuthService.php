<?php


namespace App\Services\Auth;


use App\Exceptions\AuthException;
use App\Repositories\Users\UserRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;


class AuthService extends BaseService implements AuthServiceInterface
{
    /**
     * @var JWTAuth
     */
    private $JWTAuth;

    /**
     * AuthService constructor.
     * @param UserRepositoryInterface $repository
     * @param JWTAuth $JWTAuth
     */
    public function __construct(UserRepositoryInterface $repository, JWTAuth $JWTAuth)
    {
        parent::__construct($repository);
        $this->JWTAuth = $JWTAuth;
    }

    /**
     * Register user
     * @param $attributes
     * @return mixed
     */
    public function userRegister($attributes)
    {
        $this->repository->store([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => bcrypt($attributes['password'])
        ]);

        return $this->item([
            'success' => true,
            'message' => 'Înregistrarea a fost realizată cu succes!'
        ]);
    }

    /**
     * User login
     * @param $credentials
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthException
     */
    public function userLogin($credentials)
    {
        $token = null;
        try {
            if (!$token = $this->JWTAuth->attempt($credentials)) {
                throw new AuthException('Parola sau email-ul a fost gresite!');
            }
        } catch (JWTException $e) {
            throw new AuthException('Parola sau email-ul a fost gresite!');
        }

        return $this->respondWithToken($token);
    }

    /**
     * Returns response with token
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = Auth::user();

        return $this->item([
            'success' => true,
            'access_token' => $token,
            'user' => $user,
            'token_type' => 'bearer',
        ]);
    }

    /**
     * User logout
     * @return \Illuminate\Http\JsonResponse
     */
    public function userLogout()
    {
        $this->JWTAuth->invalidate($this->JWTAuth->getToken());
        return $this->item([
            'success' => true
        ]);
    }
}
