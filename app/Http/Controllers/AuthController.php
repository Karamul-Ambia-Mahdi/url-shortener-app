<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helper\JWTToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validating data
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:30',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8'
            ]);

            // Response with errors if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'invalid',
                    'data' => $validator->errors()->all()
                ]);
            }

            // User creating with validated data
            User::Create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);

            // Response with success message
            return response()->json([
                'status' => "success",
                'message' => "User Registered Successfully."
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => "failed",
                'message' => "Something went wrong"
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            // Validating data
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            // Response with errors if validation fails
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'invalid',
                    'data' => $validator->errors()->all()
                ]);
            }

            // Finding user with given credentials
            $user = User::where('email', '=', $request->input('email'))->first();

            // Response for invalid credentials
            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return response()->json([
                    'status' => "invalid",
                    'message' => "Invalid Email or Password !"
                ]);
            }

            // Generating token for user
            $token = JWTToken::CreateToken($user->email, $user->id);

            return response()->json([
                'status' => 'success',
                'message' => "Login Successful."
            ])->cookie('token', $token, 60);
        } 
        catch (Exception $e) {
            return response()->json([
                'status' => "failed",
                'message' => "Something went wrong"
            ]);
        }
    }
}
