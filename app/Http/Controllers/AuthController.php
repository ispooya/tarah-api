<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request){
        $email = $request->email;
        $password = $request->password;

        $validated = $request->validate([
            'email' => 'email|unique:users',
            'password' => 'min:8',
        ],
        [
            'email.email' => 'فرمت ایمیل وارد شده درست نمی‌باشد.',
            'email.unique' => 'این ایمیل قبلا ثبت شده است، لطفا وارد شوید.',
            'password.min' => 'پسورد باید حداقل 8 کارکتر باشد.'
        ]);

        if ($validated) {
            DB::beginTransaction();
            try {
                $user = new User();
                $user->name = $email;
                $user->email = $email;
                $user->password = bcrypt($password);
                $user->save();
                DB::commit();

                return response()->json([
                    'signup' => true,
                ], 200);
            }catch (\Exception $e){
                DB::rollBack();
                return response()->json(['error' => $e->getMessage()], 400);
            }
        }
    }

    public function login(Request $request){
         // Login method
         if (Auth::attempt(['email'=>$request->username, 'password'=>$request->password])){
            $token = auth()->user()->createToken('NewToken')->accessToken;
            return response()->json([
                'token' => $token,
                'code' => 200
            ]);
        }else{
            return response()->json(['error'=>'Unauthorized']);
        }
    }
}
