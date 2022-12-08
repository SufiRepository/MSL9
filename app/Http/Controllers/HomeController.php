<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SnapPasukan;
use App\Models\Pasukan;
use App\Models\OrgMatriks;

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

        return view('dashboard');
    }

    public function dashbord()
    {
        return view('home');
    }

   
}
