<?php
namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\UseCases\Auth\RegisterUser;
use App\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    private $registerUseCase;
    private $users;

    public function __construct(RegisterUser $registerUseCase, UserRepositoryInterface $users) {
        $this->registerUseCase = $registerUseCase;
        $this->users = $users;
    }

    public function register(RegisterRequest $request) {
        $user = $this->registerUseCase->execute($request->validated());
        // role assignment (مثال: regular user)
        $user->assignRole('user');
        return response()->json(['user'=>$user], 201);
    }

    public function login(LoginRequest $request) {
        $credentials = $request->only(['email','password']);
        if (!Auth::attempt($credentials)) {
            // log failed attempts via telescope/auditing
            return response()->json(['message'=>'Invalid credentials'], 401);
        }
        $user = Auth::user();
        if ($user->two_factor_enabled) {
            // return response to indicate 2FA required
            return response()->json(['two_factor_required'=>true], 200);
        }
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['token'=>$token]);
    }

    public function logout() {
        Auth::user()->currentAccessToken()->delete();
        return response()->json(['message'=>'Logged out']);
    }
}
