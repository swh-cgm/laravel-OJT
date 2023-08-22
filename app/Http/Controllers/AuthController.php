<?php

namespace App\Http\Controllers;

use App\Contracts\Services\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Show login form
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Login the user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        Auth::logout();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('users.edit', Auth::user()->id);
        }

        return back()->withErrors(
            [
                'email' => 'The provided credentials do not match our records.'
            ]
        )->onlyInput('email');
    }

    /**
     * Show password change form
     *
     * @return View
     */
    public function changePassword(): View
    {
        return view('auth.changePassword');
    }

    /**
     * Store new password
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function changePasswordStore(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8|max:255',
            'new_password_confirmation' => 'required|min:8|max:255'
        ]);

        $auth = Auth::user();

        if ($auth) {
            if (Hash::check($request->current_password, $auth->password)) {
                if (Hash::check($request->new_password, $auth->password)) {
                    return back()->withErrors("New password cannot be the same with as your current password");
                }
                $this->authService->storeChangedPassword($request, $auth);
                return redirect()->route('users.edit', $auth->id);
            } elseif (!Hash::check($request->current_password, $auth->password)) {
                return back()->withErrors("Current password is incorrect.");
            } else {
                return back()->withErrors("Something went wrong.");
            }
        } else {
            return back()->withErrors("User isn't authenticated.");
        }
    }

    /**
     * Show forgot password form
     *
     * @return View
     */
    public function forgotPassword(): View
    {
        return view('auth.forgotPassword');
    }

    /**
     * Send password reset email
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function forgotPasswordEmail(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = $this->authService->sendForgotPasswordEmail($request);

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Show reset password form
     *
     * @param string $token
     * @return View
     */
    public function resetPassword(string $token): View
    {
        return view('auth.resetPassword', ['token' => $token]);
    }

    /**
     * Store new password after resetting
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function resetPasswordStore(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'email' => 'required|email'
        ]);

        $this->authService->storeResetPassword($request);
        return redirect()->route('users.index')->with(['success' => 'Password reset successful.']);
    }
}
