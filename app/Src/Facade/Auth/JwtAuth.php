<?php

namespace Api\Facade\Auth;

use Api\Exceptions\CustomException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
class JwtAuth {

    /**
     * @var string guard
     */
    private static $guard = "api";

    /**
     * @var string password resetter
     */
    private static $passwordBroker = "users";

    /**
     * Create new instance
     * @param string $guard
     * @param string $passwordBroker
     */
    public function __construct(string $guard = "api", $passwordBroker = "users")
    {
        self::$guard = $guard;
        self::$passwordBroker = $passwordBroker;
    }
    /**
     * Get the api guard\
     * @param string $guard
     * @return \Tymon\\JWTAuth\\JWTGuard
     */
    public static function guard() 
    {
        
        return Auth::guard(self::$guard);
    }

    /**
     * token response
     * @param string $token
     * @return array
     */
    public static function respondWithToken(string $token) : array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => static::guard()->factory()->getTTL() * 60
        ];
    }


    /**
     * Unauthenticate user
     * @return void
     */
    public static function logout() : void
    {
        static::guard()->logout();
    }

    /**
     * Authenticate user
     * @param array $credentials
     * @return array
     */
    public static function login(array $credentials) : array
    {
        if($token = static::guard()->attempt($credentials))
            return static::respondWithToken($token);
        
        throw new CustomException(401, "Invalid credentials.");
    }

    /**
     * Get authenticated User
     * @return \Api\Facade\Auth\Models\User|mixed
     */
    public static function user() : ?\Api\Facade\Auth\Models\User
    {
        return static::guard()->user();
    }

    /**
     * Refresh Token
     * @return array
     */
    public static function refreshToken() : array 
    {
        return static::respondWithToken(static::guard()->refresh());
    }

    /**
     * Forgot password
     * Send reset password link
     * @param array $attributes 
     * @return void
     */
    public static function forgot(array $attributes ) : array
    {
        Password::broker(self::$passwordBroker)->sendResetLink($attributes);

        return $attributes;
    }


    /**
     * Reset the password
     * @param array $attributes
     * @return array
     */
    public static function reset(array $attributes) : array 
    {
        $reset = Password::broker(self::$passwordBroker)->reset($attributes, function($user, $password){

            $user->forceFill([
                'password' => bcrypt($password)
            ])->save();
            
        });

        if($reset == Password::INVALID_TOKEN)
            throw new CustomException(400, "Invalid token.");


        return $attributes;
    }


}