<?php


namespace App\Services\Auth;


use App\Exceptions\AuthException;
use App\Services\BaseServiceInterface;

interface AuthServiceInterface extends BaseServiceInterface
{
    /**
     * Register user
     * @param $attributes
     * @return mixed
     */
    public function userRegister($attributes);

    /**
     * User login
     * @param $credentials
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthException
     */
    public function userLogin($credentials);

    /**
     * User logout
     * @return \Illuminate\Http\JsonResponse
     */
    public function userLogout();
}
