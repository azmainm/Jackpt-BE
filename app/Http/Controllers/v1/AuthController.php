<?php

namespace App\Http\Controllers\v1;

use App\Constants\ResponseMessages;
use App\Domains\Mail\MailService;
use App\Domains\User\Repositories\UserRepository;
use App\Domains\User\Services\AuthService;
use App\Enums\EmailEnum;
use function App\Helpers\randomString;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(
        protected AuthService $authService,
        protected UserRepository $user,
        protected MailService $mailService
    ) {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'checkForgotPassword', 'resetPassword']]);
    }

    /**
     * Get a JWT via given credentials.
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $checkUserExist = $this->user->checkUserExist($request->input('email'));
        if (! $checkUserExist) {
            return $this->error('User Does not Exist', 404);
        }
        $status = $this->user->checkStatus($request->input('email'));
        if ($status['status'] == 'pending') {
            return $this->error('Please Verify Your Account', 403);
        }

        $login = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        $auth = $this->authService->login($login);

        return $this->success(data: $auth);
    }

    /**
     * Register a User.
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'secret_key' => randomString(),
        ];
        $user = $this->authService->register($data, $request->input('password'));

        return $this->success(data: ['data' => $user], statusCode: 201);
    }

    /**
     * Log the user out (Invalidate the token).
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return $this->success('User successfully signed out');
    }

    /**
     * Refresh a token.
     */
    public function refresh(): JsonResponse
    {
        return $this->success(data: ['refresh_token' => auth()->refresh()]);
    }

    public function checkForgotPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email|max:100',
        ]);
        $user = $this->authService->checkUserExist($request->input('email'));
        if (! $user) {
            return $this->error(message: ResponseMessages::NOT_FOUND, statusCode: 404);
        }
        if ($user->status != 'active') {
            return $this->error(message: 'Account is not activated', statusCode: 404);
        }
        $this->user->update(['secret_key' => randomString()], $user->id);
        $user = $this->authService->checkUserExist($request->input('email'));
        $this->mailService->setMailType(EmailEnum::FORGOT_PASSWORD)
            ->setUser($user)
            ->sendEmail();

        return $this->success(data: ['message' => 'A link to reset password has been sent to your email', 'status' => 200, 'success' => true]);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'key' => 'required|string',
            'password' => 'required',
        ]);
        $user = $this->user->checkUserExistByKey(key: $request->input('key'));
        if (! $user) {
            return $this->error(message: ResponseMessages::NOT_FOUND, statusCode: 404);
        }
        $this->user->update(['password' => Hash::make($request->input('password'))], $user->id);

        return $this->success(data: ['message' => 'Password is updated', 'status' => 200, 'success' => true]);
    }
}
