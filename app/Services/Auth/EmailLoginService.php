<?php

namespace App\Services\Auth;

use App\Services\Auth\Contract\EmailLoginServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EmailLoginService implements EmailLoginServiceInterface
{
    public function sendCode(string $email): void
    {
        $code = rand(100000, 999999);

        // Eski ishlatilmagan kodlarni o'chirish
        DB::table('email_verifications')
            ->where('email', $email)
            ->where('is_used', false)
            ->delete();

        // Yangi kodni saqlash
        DB::table('email_verifications')->insert([
            'email' => $email,
            'code' => $code,
            'expires_at' => Carbon::now()->addMinutes(10),
            'is_used' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Emailga kod yuborish
        Mail::send('emails.verification-code', ['code' => $code], function ($message) use ($email) {
            $message->to($email)->subject('Tasdiqlash kodi');
        });
    }

    public function verifyCode(string $email, string $code): ?User
    {
        $verification = DB::table('email_verifications')
            ->where('email', $email)
            ->where('code', $code)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$verification) return null;

        // Kodni ishlatilgan deb belgilash
        DB::table('email_verifications')
            ->where('id', $verification->id)
            ->update(['is_used' => true]);

        // Foydalanuvchi yo‘q bo‘lsa, fake user yaratish
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => explode('@', $email)[0],
                'password' => bcrypt(Str::random(12))
            ]
        );

        Auth::login($user);

        return $user;
    }
}
