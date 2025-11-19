<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

class VerificationController extends Controller
{
    public function verify(Request $request) {
        $request->validate([
            'email' => 'required|mail',
            'code' => 'required|string|size:6'
        ]);
        $verificationCode = VerificationCode::where("email", $request->email)
        ->where('code', $request->code)
        ->valid()
        ->first();

        if (!$verificationCode) {
            return response()->json([
                'message' => 'Неверный код'
            ], 422);
        }

        $user = Users::where('email', $request->email)->firstOrFail();
        $user->update(['is_verified' => true]);


        $verificationCode->update(['used' => true]);

        $token = $user->createToken('auth-token')->plainTextToken;


        return response()->json([
            'message' => 'Email успешно подтвержден',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]
            ], 200);
    }

    public function resend(Request $request) {
        $request->validate([
            'email' => 'request|email|exist:users,email',
        ]);
        $user = Users::where('enail', $request->email)->first();

        if ($user->is_verified) {
            return response()->json([
                'message' => 'Email уже подтвержден'
            ], 422);
        }

        $this->generateAndSendVerificationCode($user->email);

        return response()->json([
            'message' => 'Код подтверждения отправлен повторно'
        ]);
    }


    public function generateAndSendVerificationCode($email) {
        VerificationCode::where('email', $email)->delete();

        $code = str_pad(random_int(0, 9999999), 5, '0', STR_PAD_LEFT);

        VerificationCode::create([
            'email' => $email,
            'code' => $code,
            'expires_at' => now()->addHours(1)
        ]);

        Mail::to($email)->send(new VerificationCode($code));
    }
    
}
