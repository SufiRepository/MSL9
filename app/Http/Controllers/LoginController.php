<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Providers\RouteServiceProvider;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use Exception;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('sanitize')->only(['register']);
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $this->checkTooManyFailedAttempts();

        $userid = $request->input('email');
        $userpass = $request->input('password');
        $remember = false;
        if($request->has('remember')) {
            $remember = $request->input('remember');
        }
        // dd($remember);
        $user = User::where('email', $userid)
            // ->orWhere('no_tentera', $userid)
            // ->orWhere('no_ic', $userid)
            ->first();
        if($user === null){
            return redirect('/')->withErrors(['email'=>'Emel tidak dijumpai.']);
        }
        // cek status akaun
        if ($user->status_akaun === "Tidak Aktif") {
            return redirect('/')->withErrors(['email'=>'Akaun Ini Belum Diaktifkan. Sila Hubungi Pentadbir Sistem.']);
        }
        $credentials["email"] = $user->email;
        $credentials["password"] = $userpass;

        if (Auth::attempt($credentials,$remember)) {
            // Authentication passed...

            RateLimiter::clear($this->throttleKey());
            return redirect()->intended(RouteServiceProvider::HOME);
        }else{
            RateLimiter::hit($this->throttleKey(), $seconds = 300);

            return redirect('/')->withErrors(['email'=>'Pengesahan tidak berjaya. Sila isi semula.']);
        }
    }
    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower(request('email')) . '|' . request()->ip();
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     */
    public function checkTooManyFailedAttempts()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        // event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
        // throw Exception('IP address banned. Too many login attempts.');
        //return redirect('/')->withErrors(['email'=>'3 Pengesahan tidak berjaya. Sila isi semula selepas 3 minit.']);

    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
