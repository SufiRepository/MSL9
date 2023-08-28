<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;
//model
use App\Models\Status;
use App\Models\Profile;
use Carbon\Carbon;

class ApplicationController extends Controller
{
    //
    public function getapplicationpage(Request $request)
    {
        $key = $this->resolveRequestSignature($request);

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return redirect('/')->withErrors(['rate_limit_exceeded' => 'Rate limit exceeded. You can perform this action again after a minute.']);
        }

        RateLimiter::hit($key, 60); // Allow 5 requests per minute

        return view('application.firstpage');
    }

    protected function resolveRequestSignature($request)
    {
        return sha1(
            $request->method() .
            '|' . $request->server('SERVER_NAME') .
            '|' . $request->path() .
            '|' . $request->ip()
        );
    }
}
