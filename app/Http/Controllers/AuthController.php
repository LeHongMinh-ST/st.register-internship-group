<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthLoginRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function __construct() {}

    public function showLoginForm(): View|Application|Factory|RedirectResponse
    {
        if (auth()->check()) {
            return redirect()->route('admin.campaigns.index');
        }

        return view('pages.auth.login');
    }

    public function login(AuthLoginRequest $request): RedirectResponse
    {
        $request->merge([$this->username() => request()->input('username')]);
        $credentials = $request->only([$this->username(), 'password']);
        if (! auth()->attempt($credentials, (bool) ($request->get('remember')))) {
            return redirect()->back()
                ->withErrors(['message' => ['Vui lòng kiểm tra lại tài khoản hoặc mật khẩu!']])
                ->withInput();
        }

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()->route('login');
    }

    private function username(): string
    {
        return filter_var(request()->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    }
}
