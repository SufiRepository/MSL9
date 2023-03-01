<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
//model
use App\Models\Status;
use App\Models\Profile;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function getregister(){

        return view('auth/register');

    }

    public function store(Request $request)
    {
        // dd($request);
        if($request->input('kategori_id') === "Staf"){
            // THIS IS KEY!
            // Replacing the old input string with
            // with an array of ...
            $k = preg_replace("/[^0-9]/", "", $request->input('no_ic'));
            $request->merge( array( 'no_tentera' => $k ) );
       }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_tentera' => ['required', 'string', 'max:255', 'unique:users'],
            'no_ic' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],

            't_lahir' => ['required'],
            'jantina' => ['required'],
            'no_phone' => ['required'],
            'kategori_id' => ['required'],
            'status_anggota' => ['required'],
            's_kahwin' => ['required'],

        ]);

        //maklumat untuk login
        $uuid = Str::orderedUuid();
        $newUser = new User();
        $newUser->id = $uuid ;
        $newUser->name               = strtoupper($request->input('name'));
        $newUser->email              = $request->input('email');
        $newUser->no_tentera         = $request->input('no_tentera');
        $newUser->no_ic              = $request->input('no_ic');
        $newUser->acc_status         = "Inactive";
        $newUser->password           = Hash::make($request->input('password'));
        $newUser->last_login         = Carbon::now();
        $newUser->save();

        //simpan maklumat profile bukan untuk login
        $newprofile = new Profile();

        $newprofile -> user_id = $uuid ;
        $newprofile -> name         = strtoupper($request->input('name'));
        $newprofile -> email              = $request->input('email');
        $newprofile -> no_tentera         = $request->input('no_tentera');
        $newprofile -> no_ic              = preg_replace("/[^0-9]/", "", $request->input('no_ic'));
        //$request->input('no_ic');

        $newprofile->acc_status           = "Inactive";

        $newprofile-> kategori           = $request->input('kategori_id');
        $newprofile-> t_lahir            = $request->input('t_lahir');
        $newprofile-> jantina            = $request->input('jantina');
        $newprofile-> no_phone           = preg_replace("/[^0-9]/", "", $request->input('no_phone'));
        //$request->input('no_phone');

        $newprofile-> pasukan_id         = $request->input('pasukan_id');
        if(NULL !== $request->input('pangkat_id')){
            $newprofile-> pangkat_id         = $request->input('pangkat_id');
        }
        $newprofile-> jawatan_id         = $request->input('jawatan_id');
        $newprofile-> agama_id           = $request->input('agama_id');
        $newprofile-> bangsa_id          = $request->input('bangsa_id');
        $newprofile-> status_anggota     = $request->input('status_anggota');
        $newprofile-> taraf_kahwin           = $request->input('s_kahwin');
        $newprofile->save();

        //$newUser->assignRole($request->input('roles'));

        //event(new Registered($newUser));

        //Auth::login($newUser);

        return view('auth/registersuccess');
    }

    public function registersuccess()
    {

        return view('auth/registersuccess');
    }
    public function contactadmin()
    {

        return view('auth/forgot-password');
    }
}
