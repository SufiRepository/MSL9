<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;

use App\Models\OrgMatriks;
use App\Models\Pasukan;
use App\Models\Saluran;

class OrgMatriksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:orgmatriks-list|orgmatriks-create|orgmatriks-edit|orgmatriks-delete', ['only' => ['index','show']]);
         $this->middleware('permission:orgmatriks-create', ['only' => ['create','store']]);
         $this->middleware('permission:orgmatriks-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:orgmatriks-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
    $saluran = Saluran::all();

    return view('orgmatriks.index',compact('saluran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pasukan = Pasukan::all();
        $saluran = Saluran::all();
        return view('orgmatriks.create',compact('pasukan','saluran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pasukan           =  $request->input('pasukan_id');
        $parent    = $request->input('parentId');

        if ( $checkpasukan = OrgMatriks::where('parentId', $pasukan)->exists()) {

        }

        if( $pasukan != $parent){

        // dd("lain parent")  ;

        $user_id= Auth::user()->id;



        $uuid = Str::orderedUuid();
        $org_matriks = new OrgMatriks();
        $org_matriks    ->  unit_id       = $request->input('pasukan_id');
        $org_matriks    ->  parentId      = $request->input('parentId');
        $org_matriks    ->  saluran_id    = $request->input('saluran_id');
        $org_matriks    ->  id            = $uuid;
        $org_matriks    ->  created_by    = $user_id;
        $org_matriks    ->  save();


        return redirect()->route('orgchartview',['id'=>$org_matriks    ->  saluran_id]) ->with('success','Berjaya ditambah');

     }else{
        return redirect()->route('orgmatriks.index') ->with('error','DAH JADI PARENT');
     }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pasukan = Pasukan::find($id);
        return view('orgmatriks.editpasukan',compact('pasukan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

        // return redirect()->route('pasukan.index')
        //                 ->with('success','Pasukan updated successfully');
        $data = OrgMatriks:: join("og_unit","og_unit.id","=","org_matriks.unit_id")
                            ->join("og_saluran","og_saluran.id","=","org_matriks.saluran_id")
                            ->select('org_matriks.unit_id as id','org_matriks.unit_id as create_parent','org_matriks.id as show_id','org_matriks.saluran_id', 'parentId','og_unit.nama as NAMA',)
                            ->where('org_matriks.saluran_id',$id)->get()->toArray();
        $saluran = Saluran::all();
        $namasaluran =  Saluran::all()->where('id',$id)->first();
        $getAllMatrikSaluran = OrgMatriks::where('saluran_id',$id)->get();
        $listUnitId = [];
        foreach($getAllMatrikSaluran as $gAMS)
        {
                       $listUnitId[] = $gAMS->unit_id;
        }
        $pasukan =Pasukan::whereNotIn('id', $listUnitId)->get();


        $nama_saluran=$namasaluran->nama;
        $id_saluran=$id;

        return view('orgmatriks.detail',compact('data','saluran','nama_saluran','pasukan','id_saluran'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($unit_id,$saluran_id,$matrik_id)
    {
        // dd($unit_id);

         if( OrgMatriks::where('parentId',$unit_id)->where('saluran_id',$saluran_id) ->exists())  {
            // return redirect()->route('orgmatriks.index')->with('success','Tidak berjaya di padam');
            return redirect()->route('orgchartview',['id'=>$saluran_id]) ->with('error','PASUKAN TIDAK BERJAYA DI PADAM.');
         }

        OrgMatriks::where('id',$matrik_id)->delete();

        return redirect()->route('orgchartview',['id'=>$saluran_id]) ->with('success','PASUKAN BERJAYA DI PADAM .');
    }


    public function orgchartview($id)
    {
        // dd($id);
        $data = OrgMatriks:: join("og_unit","og_unit.id","=","org_matriks.unit_id")
                            ->join("og_saluran","og_saluran.id","=","org_matriks.saluran_id")
                            ->select('org_matriks.unit_id as id','org_matriks.unit_id as create_parent','org_matriks.id as show_id','org_matriks.saluran_id', 'parentId','og_unit.nama as NAMA',)
                            ->where('org_matriks.saluran_id',$id)->get()->toArray();


        $saluran = Saluran::all();

        $namasaluran =  Saluran::all()->where('id',$id)->first();

        $getAllMatrikSaluran = OrgMatriks::where('saluran_id',$id)->get();
        $listUnitId = [];

        foreach($getAllMatrikSaluran as $gAMS)
        {
                       $listUnitId[] = $gAMS->unit_id;
        }

        $pasukan =Pasukan::whereNotIn('id', $listUnitId)->get();


        $nama_saluran=$namasaluran->nama;
        $id_saluran=$id;

        return view('orgmatriks.detail',compact('data','saluran','nama_saluran','pasukan','id_saluran'));

    }

    public function updateorgmatrix($newparentId, $matrikid)
    {
        // dd($matrikid);
        $OrgMatrik = OrgMatriks::find($matrikid);
        $OrgMatrik->parentId   = $newparentId;
        $OrgMatrik    ->save();


        return redirect()->route('orgchartview',['id'=>$OrgMatrik -> saluran_id]) ->with('success','PasukaN Berjaya Ditambah');

        return view('orgmatriks.detail',compact('data','saluran','nama_saluran','pasukan','id_saluran'));
    }

    public function orgcharteditpasukan($idpasukan,$idsaluran)
    {
        $pasukan = Pasukan::find($idpasukan);
        $saluran_id = $idsaluran;
        $pasukan_id = $idpasukan;
        return view('orgmatriks.editpasukan',compact('pasukan','saluran_id','pasukan_id'));
    }

    public function orgchartupdatepasukan(Request $request, $idpasukan, $idsaluran)
    {
        // dd($idsaluran);
        $user_id= Auth::user()->id;
        $updatepasukan = Pasukan::find($idpasukan);
        $updatepasukan->nama          = strtoupper($request->input('nama'));;
        $updatepasukan->singkatan     = strtoupper($request->input('singkatan'));
        $updatepasukan->flagship      = strtoupper($request->input('flagship'));
        $updatepasukan->kem           = strtoupper($request->input('kem'));
        $updatepasukan->negeri        = strtoupper($request->input('negeri'));
        $updatepasukan->lokasi        = strtoupper($request->input('lokasi'));
        $updatepasukan->kod_unit      = strtoupper($request->input('kod_unit'));
        $updatepasukan->kod_emerys    = strtoupper($request->input('kod_emerys'));
        $updatepasukan->kod_spake     = strtoupper($request->input('kod_spake'));
        $updatepasukan->kod_aims      = strtoupper($request->input('kod_aims'));
        $updatepasukan->kod_spatd     = strtoupper($request->input('kod_spatd'));
        $updatepasukan->kod_sutera    = strtoupper($request->input('kod_sutera'));
        $updatepasukan->updated_by    =   $user_id;
        $updatepasukan->save();


        // return redirect()->route('orgchartview',['id'=>$OrgMatrik -> saluran_id]) ->with('success','Berjaya ditambah');
        return redirect()->route('orgchartview',['id'=>$idsaluran]) ->with('success','Pasukan berjaya disimpan.');
    }

    public function orgchartcreatepasukan($idsaluran)
    {
        $saluran_id = $idsaluran;
        return view('orgmatriks.createpasukan',compact('saluran_id'));
    }

    public function orgchartstorepasukan(Request $request,$idsaluran)
    {
        // dd($idsaluran);
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

        return redirect()->route('orgchartview',['id'=>$idsaluran]) ->with('success','Pasukan berjaya disimpan.');
    }
}
