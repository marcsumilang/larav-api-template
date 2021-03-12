<?php

namespace Api\V1_0_0\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Api\V1_0_0\Http\Requests\LoginRequest;
use Api\V1_0_0\Services\User\AuthService;
use Api\V1_0_0\Http\Requests\RegisterUserRequest;

class AuthController extends Controller
{

    /**
     * @var \Api\V1_0_0\Services\User\AuthService $authService
     */
    private $authService;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login','register','forgot','reset']]);

        $this->authService = $authService;
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Api\V1_0_0\Requests\LoginRequest $request;
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    { 
        $credentials = $request->only("email","password");

        $responseData = $this->authService->login($credentials);

        $message = "Successfully authenticated.";

        return $this->response($message, $responseData);
    }

    /**
     * Get the authenticated User
     * @param \Illuminate\Http\Request $request;
     * @return \Illuminate\Http\JsonResponse
     */
    public function account(Request $request)
    {
        $responseData = $this->authService->myAccount();

        $message = "My account";

        return $this->response($message, $responseData);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->authService->logout();

        $message = "My account";

        return $this->response($message, []);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $responseData =  $this->authService->refreshToken();

        $message = "Access token refreshed.";

        return $this->response($message, $responseData);
    }

    /**
     * Register user
     * @param  \Api\V1_0_0\Requests\RegisterUserRequest $request;
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request)
    {
        $data = $request->all();

        $responseData = $this->authService->register($data);

        $message = "Successfuly registered! We sent you an email to verify your account.";

        return $this->response($message,$responseData);
    }

    /**
     * Send forgot password link
     * @param \Illuminate\Http\Request $request;
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgot(Request $request)
    {
        $email = $request->validate([ "email" => "required|email"]);

        $this->authService->forgotPassword($email);

        $message = "We sent you a link to reset your password. Please check your email.";

        return $this->response($message, $email);
    }

    /**
     * Reset password
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(Request $request) 
    {
        $data = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $responseData = $this->authService->resetPassword($data);

        $message = "Your password has been reset successfully.";

        return $this->response($message, $responseData);
    }
}