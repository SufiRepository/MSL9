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
use App\Models\Pasukan;
use App\Models\Status;
use App\Models\Jawatan;
use App\Models\Pangkat;
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

        // $data = User::orderBy('id','DESC')->get();
        // $pasukandata = DB::table('og_unit')->where('user_id','=',$data->id)->first();

        $data = User::orderBy('id','DESC')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.*','profiles.pasukan_id')
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
            'password' => ['required', 'confirmed', 'min:6'],
            't_lahir' => ['required'],
            'jantina' => ['required'],
            'no_phone' => ['required'],
            'roles_id' => ['required'],
        ]);

        //maklumat untuk login
        $uuid = Str::orderedUuid();
        $newUser = new User();
        $newUser->id = $uuid ;
        $newUser->name               = strtoupper($request->input('name'));
        $newUser->email              = $request->input('email');
        if(NULL !== $request->input('status_akaun')){
            $newUser-> status_akaun         = $request->input('status_akaun');
        }else{
            $newUser->status_akaun       = "Tidak Aktif";
        }
        $newUser->password           = Hash::make($request->input('password'));
        $newUser->last_login         = Carbon::now();
        $newUser->email_verified_at         = Carbon::now();
        $newUser->save();

        //simpan maklumat profile bukan untuk login
        $newprofile = new Profile();

        $newprofile -> user_id = $uuid ;
        $newprofile -> nama_penuh         = strtoupper($request->input('name'));
        $newprofile -> email              = $request->input('email');

        // $newprofile->status_akaun           = "Tidak Aktif";
        if(NULL !== $request->input('status_akaun')){
            $newprofile-> status_akaun         = $request->input('status_akaun');
        }else{
            $newprofile->status_akaun       = "Tidak Aktif";
        }
        $newprofile-> kategori           = $request->input('kategori_id');
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
        if($updateUser->no_tentera !== $request->input('no_tentera')){
            $request->validate([
                'no_tentera' => ['required', 'string', 'max:255', 'unique:users'],
            ]);
            $updateUser->no_tentera         = $request->input('no_tentera');
        }
        if($updateUser->no_ic !== preg_replace("/[^0-9]/", "", $request->input('no_ic'))){
            $request->validate([
                'no_ic' => ['required', 'string', 'max:255', 'unique:users'],
            ]);
            $updateUser->no_ic              = preg_replace("/[^0-9]/", "", $request->input('no_ic'));
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
            $updateUser-> status_akaun         = $request->input('status_akaun');
        }else{
            $updateUser->status_akaun       = "Tidak Aktif";
        }
        $updateUser->email_verified_at         = Carbon::now();
        $updateUser->update();

        //simpan maklumat profile bukan untuk login
        $updateprofile = Profile::where('user_id','=',$id )->first();
        $updateprofile -> nama_penuh         = $updateUser->name;
        $updateprofile -> email              = $request->input('email');
        $updateprofile -> no_tentera         = $request->input('no_tentera');
        $updateprofile -> no_ic              = $updateUser->no_ic;

        $updateprofile-> t_lahir            = $request->input('t_lahir');
        $updateprofile-> jantina            = $request->input('jantina');
        $updateprofile-> no_phone           = preg_replace("/[^0-9]/", "", $request->input('no_phone'));
        $updateprofile-> status_akaun         = $updateUser->status_akaun;
        //$request->input('no_phone');
        // if(NULL !== $request->input('status_akaun')){
        //     $updateprofile-> status_akaun         = $request->input('status_akaun');
        // }else{
        //     $updateprofile->status_akaun       = "Tidak Aktif";
        // }
        $updateprofile-> pasukan_id         = $request->input('pasukan_id');
        $updateprofile-> pangkat_id         = $request->input('pangkat_id');
        $updateprofile-> jawatan_id         = $request->input('jawatan_id');
        $updateprofile-> agama_id           = $request->input('agama_id');
        $updateprofile-> bangsa_id          = $request->input('bangsa_id');
        $updateprofile-> status_anggota     = $request->input('status_anggota');
        $updateprofile-> taraf_kahwin       = $request->input('s_kahwin');
        $updateprofile-> update();

        //clear roles, then add new roles
        $updateUser->roles()->detach();
        $updateUser->assignRole($request->input('roles_id'));

        return redirect()->route('users.index')
                        ->with('success','Pengguna updated successfully');
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
        $updateUser->status_akaun         = "Aktif";
        $updateUser->update();
        return redirect()->route('users.index')
                        ->with('success','Pengguna updated successfully');

    }

    public function edittidakaktifakaun($id)
    {
        $updateUser = User::find($id);
        // dd($updateUser->status_akaun);
        $updateUser->status_akaun         = "Tidak Aktif";
        $updateUser->update();
        return redirect()->route('users.index')
                        ->with('success','Pengguna updated successfully');

    }

    public function byFilter($id)
    {
        // dd($id);
        if($id === "Arkib"){
            $data = User::onlyTrashed()
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.*','profiles.pasukan_id')
            ->get();

            // dd($data);
            $pasukandata = DB::table('og_unit')->get();
            for ($x = 0; $x < count($data); $x++)
            {
                for ($y = 0; $y < count($pasukandata); $y++){
                    if($data[$x]->pasukan_id == $pasukandata[$y]->id){
                        $data[$x]->pasukan_id = $pasukandata[$y]->singkatan;
                    }
                }
            }
            return view('users.archive',compact('data'));

        }
        else if($id === "Pendaftaran Baru"){
            $data = User::orderBy('id','DESC')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.*','profiles.pasukan_id')
            ->where('email_verified_at','=',NULL)
            ->get();
            $pasukandata = DB::table('og_unit')->get();
            for ($x = 0; $x < count($data); $x++)
            {
                for ($y = 0; $y < count($pasukandata); $y++){
                    if($data[$x]->pasukan_id == $pasukandata[$y]->id){
                        $data[$x]->pasukan_id = $pasukandata[$y]->singkatan;
                    }
                }
            }
            return view('users.index',compact('data'));
        }
        else if($id === "Semua"){
            $data = User::orderBy('id','DESC')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.*','profiles.pasukan_id')
            ->where('deleted_at','=',NULL)
            ->get();
            $pasukandata = DB::table('og_unit')->get();
            for ($x = 0; $x < count($data); $x++)
            {
                for ($y = 0; $y < count($pasukandata); $y++){
                    if($data[$x]->pasukan_id == $pasukandata[$y]->id){
                        $data[$x]->pasukan_id = $pasukandata[$y]->singkatan;
                    }
                }
            }
            return view('users.index',compact('data'));
        }else{
            $data = User::orderBy('id','DESC')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.*','profiles.pasukan_id')
            ->where('users.status_akaun',$id)
            ->get();

            $pasukandata = DB::table('og_unit')->get();
            for ($x = 0; $x < count($data); $x++)
            {
                for ($y = 0; $y < count($pasukandata); $y++){
                    if($data[$x]->pasukan_id == $pasukandata[$y]->id){
                        $data[$x]->pasukan_id = $pasukandata[$y]->singkatan;
                    }
                }
            }
            return view('users.index',compact('data'));
        }
    }

    public function archiveshow($id)
    {
        // $user = User::find($id);
        $user = User::where('id',$id)->withTrashed()->first();
        $profile = DB::table('profiles')->where("user_id",$id)->first();
        $pasukan = DB::table('og_unit')->where("id",$profile->pasukan_id)->first();
        $pangkat = DB::table('pangkat')->where("id_pangkat",$profile->pangkat_id)->first();
        $taraf_kahwin = DB::table('lib_taraf_kahwin')->where("idTarafKahwin",$profile->taraf_kahwin)->first();
        $agama = DB::table('lib_agama')->where("idAgama",$profile->agama_id)->first();
        $jawatan = DB::table('lib_jawatan')->where("id",$profile->jawatan_id)->first();

         //dd($profile);

        return view('users.show',compact(
                'user',
                'profile',
                'pasukan',
                'pangkat',
                'taraf_kahwin',
                'agama',
                'jawatan',
            ));
    }

}
