<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;



class AuthController extends Controller
{
    public function register(Request $request) 
    {
        // Setup validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8'
        ]);

        // Cek validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Cek keberhasilan
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user
            ]);
        }

        // Cek gagal
        return response()->json([
            'success' => false,
            'message' => 'User creation failed'
        ], 409); // Conflict
    }


    public function login(Request $request)
    {
        // Setup validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Get kredensial dari request
        $credentials = $request->only('email', 'password');

        // Cek isFailed
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Email dan Password anda salah!'
            ], 401);
        }

        // Cek isSuccess
        return response()->json([
            'success' => true,
            'message' => 'Login successfully!',
            'user' => auth()->guard('api')->user(),
            'token' => $token,
        ], 200);
    }


    public function logout(Request $request)
    {
        try {
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully!'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout failed!' 
            ], 500);
        }
    }
}
