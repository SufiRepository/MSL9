<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Pasukan;
use App\Models\Markas;
use App\Models\FileUpload;
use Illuminate\Support\Str;
use DB;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PasukanController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:pasukan-list|pasukan-create|pasukan-edit|pasukan-delete', ['only' => ['index','show']]);
         $this->middleware('permission:pasukan-create', ['only' => ['create','store']]);
         $this->middleware('permission:pasukan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pasukan-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Pasukan::orderBy('id','DESC')->get();

        // dd($pasukan->name)

        // $report = "Keseluruhan Pasukan";
        // $arraypasukans = Pasukan::select('id','parentId','singkatan as NAMA','kem')->get()->toArray();

        // dd( $arraypasukans);

        $part= "all";
        // return view('pasukan.index',compact('report','arraypasukans','part'));
        return view('pasukan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pasukans =Pasukan::all();

        $permission = Permission::get();
        return view('pasukan.create',compact('permission','pasukans'));

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uuid = Str::orderedUuid();

        $user_id= Auth::user()->id;

        $uuid = Str::orderedUuid();

        //maklumat untuk login
        $pasukan = new Pasukan();
        $pasukan->id            = $uuid ;
        $pasukan->nama          = strtoupper($request->input('nama'));;
        $pasukan->singkatan     = strtoupper($request->input('singkatan'));
        $pasukan->flagship      = strtoupper($request->input('flagship'));
        $pasukan->kem           = strtoupper($request->input('kem'));
        $pasukan->negeri        = strtoupper($request->input('negeri'));
        $pasukan->lokasi        = strtoupper($request->input('lokasi'));
        $pasukan->kod_unit      = strtoupper($request->input('kod_unit'));
        $pasukan->kod_emerys    = strtoupper($request->input('kod_emerys'));
        $pasukan->kod_spake     = strtoupper($request->input('kod_spake'));
        $pasukan->kod_aims      = strtoupper($request->input('kod_aims'));
        $pasukan->kod_spatd     = strtoupper($request->input('kod_spatd'));
        $pasukan->kod_sutera    = strtoupper($request->input('kod_sutera'));
        $pasukan->created_by    =   $user_id;

        $pasukan->save();
        if($request->hasFile('pasukanlogo')) {
            $pasukanfiles   = new FileUpload;

            $pasukanfilespath = $file->storeAs('project_files', $fileName, 'public');

            $pasukanfiles->filename = $request->filename.'.'.$request->imageFile->getClientOriginalExtension();
            $pasukanfiles->pasukan_id = $pasukan->id;
            $pasukanfiles->name = $request->filename;
            $pasukanfiles->file_path = '/storage/' . $projectfilespath;
            $pasukanfiles->file_location = ('upload');
            // $pasukanfiles->notes = $helpdesk->status;
            $pasukanfiles->save();

        }

        return redirect()->route('pasukan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pasukan =  Pasukan::find($id);

        return view('pasukan.show',compact('pasukan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $pasukan = Pasukan::find($id);

        if($pasukan->parentId == null){
            $parrentname = null;
        }{
            $parrentname = Pasukan::where('id','=',$pasukan->parentId)->first();
        }

        $allPasukan = Pasukan::all();

        $report = $pasukan->nama;
        return view('pasukan.edit',compact('pasukan','report','parrentname','allPasukan'));
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
        $user_id= Auth::user()->id;
        $pasukan = Pasukan::find($id);
        $pasukan->nama          = strtoupper($request->input('nama'));;
        $pasukan->singkatan     = strtoupper($request->input('singkatan'));
        $pasukan->flagship      = strtoupper($request->input('flagship'));
        $pasukan->kem           = strtoupper($request->input('kem'));
        $pasukan->negeri        = strtoupper($request->input('negeri'));
        $pasukan->lokasi        = strtoupper($request->input('lokasi'));
        $pasukan->kod_unit      = strtoupper($request->input('kod_unit'));
        $pasukan->kod_emerys    = strtoupper($request->input('kod_emerys'));
        $pasukan->kod_spake     = strtoupper($request->input('kod_spake'));
        $pasukan->kod_aims      = strtoupper($request->input('kod_aims'));
        $pasukan->kod_spatd     = strtoupper($request->input('kod_spatd'));
        $pasukan->kod_sutera    = strtoupper($request->input('kod_sutera'));
        $pasukan->updated_by    =   $user_id;
        $pasukan->save();

        // return redirect()->route('pasukan.show',   $pasukan->id );
        return redirect()->route('pasukan.index')
                        ->with('success','Pasukan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Pasukan::find($id)->delete();
        return redirect()->route('pasukan.index')
                        ->with('success','Pasukan deleted successfully');
    }
}
