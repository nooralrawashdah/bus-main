<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{    public function showLoginForm()
    {
        return view('auth.login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {
        // 1. تحقق من البيانات
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // 2. حاول تسجيل الدخول
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. توجيه حسب نوع المستخدم
            $user = Auth::user();

            if ($user->user_type === 'driver') {
                return redirect()->route('driver.dashboard');
            } elseif ($user->user_type === 'admin') {
                return redirect()->route('manger.mdashboard');
            } else {
                return redirect('users.userdashboard');
            }
        }

        // 4. إذا فشل تسجيل الدخول
        return back()->withErrors([

            'email' => 'بيانات الدخول غير صحيحة.',
        ])->onlyInput('email');
    }

    // تسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
