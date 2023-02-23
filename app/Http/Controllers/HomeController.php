<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->get();
        $unreadCount = Auth::user()->unreadNotifications()->count();

        return view('dashboard', compact('user','notifications','unreadCount'));
    }

    public function dashbord()
    {
        return view('home');
    }

   
}
