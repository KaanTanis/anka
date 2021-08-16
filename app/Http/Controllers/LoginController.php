<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers
 */
class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        if (request()->isMethod('get'))
            return view('admin.login');

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            \App\Models\Log::create([
                'title' => 'Giriş Yapıldı',
                'log_type' => 'login_success',
                'log_details' => json_encode([
                    'ip' => \request()->ip(),
                    'user_agent' => \request()->userAgent(),
                    'request' => $request->all()
                ])
            ]);

            return redirect()->intended('admin.home');
        }

        \App\Models\Log::create([
            'title' => 'Giriş Denemesi',
            'log_type' => 'login_fail',
            'log_details' => json_encode([
                'ip' => \request()->ip(),
                'user_agent' => \request()->userAgent(),
                'request' => $request->all()
            ])
        ]);

        return back()->withMessage(__('Kullanıcı adı veya şifre hatalı'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        \App\Models\Log::create([
            'title' => 'Çıkış Yapıldı',
            'log_type' => 'logout',
            'log_details' => json_encode([
                'ip' => \request()->ip(),
                'user_agent' => \request()->userAgent(),
                'request' => $request->all()
            ])
        ]);

        return redirect('/');
    }
}
