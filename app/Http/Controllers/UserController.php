<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Hash;
use DB;

//model
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use App\Models\Profile;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')
            ->where('deleted_at','=',NULL)
            ->get();
        // dd($data);
        $navlink = array('pengurusan_pengguna','pengguna');
        return view('users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        // dd($roles);
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            //'t_lahir' => ['required'],
            //'jantina' => ['required'],
            'no_phone' => ['required'],
            //'roles_id' => ['required'],
        ]);

        //maklumat untuk login
        $uuid = Str::orderedUuid();
        $newUser = new User();
        $newUser->id = $uuid ;
        $newUser->name               = strtoupper($request->input('name'));
        $newUser->email              = $request->input('email');
        if(NULL !== $request->input('status_akaun')){
            $newUser-> acc_status         = $request->input('status_akaun');
        }else{
            $newUser->acc_status       = "Inactive";
        }
        $newUser->password           = Hash::make($request->input('password'));
        $newUser->last_login         = Carbon::now();
        $newUser->email_verified_at         = Carbon::now();
        $newUser->save();

        //simpan maklumat profile bukan untuk login
        $newprofile = new Profile();

        $newprofile -> user_id = $uuid ;
        $newprofile -> name         = strtoupper($request->input('name'));
        $newprofile -> email              = $request->input('email');

        // $newprofile->acc_status           = "Inactive";
        if(NULL !== $request->input('status_akaun')){
            $newprofile-> acc_status         = $request->input('status_akaun');
        }else{
            $newprofile->acc_status       = "Inactive";
        }
        $newprofile-> t_lahir            = $request->input('t_lahir');
        $newprofile-> no_phone           = preg_replace("/[^0-9]/", "", $request->input('no_phone'));
        $newprofile->save();

        $newUser->assignRole($request->input('roles_id'));

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $profile = DB::table('profiles')->where("user_id",$id)->first();
     
        return view('users.show',compact(
                'user',
                'profile',
            ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $user    = User::find($id);
        $profile = DB::table('profiles')->where('user_id','=',$id)->first();
        $roles   = Role::all();
        $myroles = $user->getRoleNames();


        return view('users.edit',compact('user','profile','roles','myroles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //maklumat untuk login
        $updateUser = User::find($id);
        $updateUser->name               = strtoupper($request->input('name'));
        if($updateUser->email !== $request->input('email')){
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                // 'no_tentera' => ['required', 'string', 'max:255', 'unique:users'],
                // 'no_ic' => ['required', 'string', 'max:255', 'unique:users'],
            ]);
            $updateUser->email              = $request->input('email');
        }
        //dd($request->input('password'));
        if(NULL !== $request->input('password')){
            // dd($request->input('password'));
            $request->validate([
                'password' => ['required', 'confirmed', 'min:6'],
            ]);
            $updateUser->password = Hash::make($request->input('password'));
        }
        if(NULL !== $request->input('status_akaun')){
            $updateUser-> acc_status         = $request->input('status_akaun');
        }else{
            $updateUser->acc_status       = "Inactive";
        }
        $updateUser->email_verified_at         = Carbon::now();
        $updateUser->update();

        //simpan maklumat profile bukan untuk login
        $updateprofile = Profile::where('user_id','=',$id )->first();
        $updateprofile -> name         = $updateUser->name;
        $updateprofile -> email              = $request->input('email');
        $updateprofile-> t_lahir            = $request->input('t_lahir');
        $updateprofile-> no_phone           = preg_replace("/[^0-9]/", "", $request->input('no_phone'));
        $updateprofile-> acc_status         = $updateUser->acc_status;
        //$request->input('no_phone');
        // if(NULL !== $request->input('status_akaun')){
        //     $updateprofile-> acc_status         = $request->input('status_akaun');
        // }else{
        //     $updateprofile->acc_status       = "Inactive";
        // }
        $updateprofile-> update();

        //clear roles, then add new roles
        $updateUser->roles()->detach();
        $updateUser->assignRole($request->input('roles_id'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userdata = User::find($id);

        // dd($userdata);
        $userdata->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function editaktifakaun($id)
    {
        $updateUser = User::find($id);
        // dd($updateUser->status_akaun);
        $updateUser->acc_status         = "Active";
        $updateUser->update();
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');

    }

    public function edittidakaktifakaun($id)
    {
        $updateUser = User::find($id);
        // dd($updateUser->acc_status);
        $updateUser->acc_status         = "Inactive";
        $updateUser->update();
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');

    }

    public function importView(Request $request){
        return view('importFile');
    }

    public function import(Request $request){
        Excel::import(new ImportUser, $request->file('file')->store('files'));

        return redirect()->back()->with('success','Import User successful.');;
    }

    public function exportUsers(Request $request){
        return Excel::download(new ExportUser, 'users.csv');
    }

    public function userscsv(){
        $file = storage_path('app/files/users.csv');

        if (!file_exists($file)) {
            return redirect()->back()->with('error', 'File not found');
        }

        $rows = array_map('str_getcsv', file($file));

        return view('users.userscsv', compact('rows'));
    }
}
