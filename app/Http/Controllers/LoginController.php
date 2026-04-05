<?php

// 型チェックを厳しくする宣言
declare(strict_types=1);

// 未使用？に見えるけど実はControllersディレクトリまでの名前空間を表しているので使っている
namespace App\Http\Controllers;

// 現在は使われなくなった様子
// use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'message' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }

    public function logout() {
        Auth::logout();
        $request->session()->invalidate();
        
        request()->session()->regenerateToken();

        return redirect(RouteServiceProvider::HOME);
    }
}
