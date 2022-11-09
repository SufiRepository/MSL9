<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr; 
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;

use App\Models\Saluran;
use App\Models\Pasukan;
use App\Models\OrgMatriks;
class SaluranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:saluran-list|saluran-create|saluran-edit|saluran-delete', ['only' => ['index','show']]);
         $this->middleware('permission:saluran-create', ['only' => ['create','store']]);
         $this->middleware('permission:saluran-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:saluran-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Saluran::orderBy('id','DESC')->get();
        return view('saluran.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('saluran.create');

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
        $user_id= Auth::user()->user_id;
        $unit = Pasukan::select('*')->where('id','21ece77a-4382-11ed-8dfb-0242ac110002')->first();
        
        $saluran = new Saluran();
        $saluran    ->  nama            = strtoupper($request->input('nama')); 
        $saluran    ->  kod_saluran     = strtoupper($request->input('kod_saluran'));
        $saluran    ->  id              = $uuid;
        $saluran_id =  $saluran    ->  id;   
        $saluran    ->  created_by      = $user_id;
        $saluran    ->  save();     

        $org_matriks  = new OrgMatriks();
        $org_matriks    ->  unit_id         = $unit->id;
        $org_matriks    ->  saluran_id      = $saluran_id;
        $org_matriks    ->  id              = $uuid;
        $org_matriks    ->  created_by      = $user_id;
        $org_matriks    ->  save();

        return redirect()->route('saluran.index') ->with('success','Saluran berjaya ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $saluran = Saluran::find($id);
        
        return view('saluran.show',compact('saluran'));
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
        $saluran = Saluran::find($id);

        return view('saluran.edit',compact('saluran'));
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
        $saluran = Saluran::find($id);
        $saluran    ->nama                  = strtoupper($request->input('nama'));
        $saluran    ->kod_saluran           = strtoupper($request->input('kod_saluran'));
        $saluran    ->save();   

        return redirect()->route('saluran.show',   $saluran->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
             
        Saluran::find($id)->delete();
        return redirect()->route('saluran.index')
                        ->with('success','Saluran berjaya di padam');
    }
}
