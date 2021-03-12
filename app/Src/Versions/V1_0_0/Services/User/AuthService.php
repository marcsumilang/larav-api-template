<?php

namespace Api\V1_0_0\Services\User;

use Api\Facade\Auth\JwtAuth;
use Illuminate\Support\Facades\Mail;
use Api\V1_0_0\UseCases\User\{
    Register\Register,
    Register\VerifyEmail\Mail as VerifyEmail
};

use Api\V1_0_0\Repositories\User\UserInterface;

class AuthService 
{
    /**
     * @var \Api\V1_0_0\Repositories\User\UserInterface $userInterface
     */
    private $userInterface;
    public function __construct(UserInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }
    /**
     * Register User
     * @param array $attributes
     * @return array
     */
    public function register(array $attributes) : array 
    {
        
        $user = (new Register($attributes, $this->userInterface))();

        Mail::to($user->email)->send(new VerifyEmail($user));

        $credentials = [
            "email" => $attributes["email"],
            "password" => $attributes["password"]
        ];

        return JwtAuth::login($credentials);

    }

    /**
     * Authenticate User
     * @param array $credentials
     * @return array|\Api\Exceptions\CustomException
     */
    public function login(array $credentials) : ?array
    {   
        
        return JwtAuth::login($credentials);

    } 

    /**
     * Get the authenticated user
     * @return \Api\Models\User
     */
    public function myAccount() : \Api\Facade\Auth\Models\User 
    {

        return JwtAuth::user();

    }

    /**
     * Send reset password link
     * @param array $attributes
     * @return array
     */
    public function forgotPassword(array $attributes) : array
    {

        return JwtAuth::forgot($attributes);

    }

    /**
     * Reset password
     * @param array $attributes
     * @return array|\Api\Exceptions\CustomException
     */
    public function resetPassword(array $attributes) : array
    {

        return JwtAuth::reset($attributes);

    } 

    /**
     * Logout authenticated user
     * @return void
     */
    public function logout() : void
    {

        JwtAuth::logout();

    }

    /**
     * Refresh access token
     * @return array
     */
    public function refreshToken() : array
    {
        return JwtAuth::refreshToken();
    }
}