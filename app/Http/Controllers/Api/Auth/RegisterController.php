<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);
        
         try {
            DB::beginTransaction();

            $user = Users::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_verified' => false,
                'role' => 'user'
            ]);

            $verificationCode = $this->generateVerificationCode($user->email);

            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

            DB::commit();

            return response()->json([
                'message' => 'Регистрация пройдена успешно. Пожалуйста проверьте ваш email на наличией кода верификации',
                'user' => [
                    'name' =>$user->name,
                    'email' => $user->email,
                    'role' => $user->role
                ]
                ],201);

            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'message' => 'Регистрация неуспешна',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

    private function generateVerificationCode($email) {
        
        VerificationCode::where('email', $email)->delete();

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        VerificationCode::create([
            'email' => $email,
            'code' => $code,
            'expires_at' => now()->addHours(1),
        ]);

        return $code;
    }
}

