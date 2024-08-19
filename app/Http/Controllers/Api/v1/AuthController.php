<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginUserEmail(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Loggin Failed',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            if ($user = User::where(['email' => $request->email])->first()) {
                return response()->json([
                    'status' => true,
                    'message' => '',
                    'data' => null,
                ], 200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => null
            ], 401);
        }
    }

    public function loginUserPassword(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Loggin Failed',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            if (!Auth::guard()->attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Password does not match',
                    'errors' => null
                ], 401);
            }
            $user = User::where(['email' => $request->email])->first();
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'data' => ['token' => $user->createToken('API_TOKEN')->plainTextToken]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => null
            ], 401);
        }
    }

    public function createUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'first_name' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:frontend_users,email',
                'phone' => 'required',
                'password' => 'required|confirmed'
            ]);
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Loggin Failed',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'data' => ['token' => $user->createToken('API_TOKEN')->plainTextToken]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => null
            ], 401);
        }
    }

    public function getUserDetails(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'message' => 'Successfully',
                'data' => $request->user()
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => null
            ], 401);
        }
    }

    function logOutUser(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json([
                'status' => true,
                'message' => 'User Logged Out Successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'errors' => null
            ], 401);
        }
    }
}
