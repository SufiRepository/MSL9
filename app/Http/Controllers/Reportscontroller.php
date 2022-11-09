<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasukan;
use App\Models\Markas;


class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reports.index');
    }


    public function treelist()
    {
        // dd("treelist");
        return view('reports.treelist');
    }

    public function chart()
    {
        // dd("treelist");
        return view('reports.chart');
    }

    public function pasukanreport()
    {
        $report = "laporan Pasukan Khas";

        $arraypasukans = Pasukan::select('id','parentId','nama','nama_kem')->get()->toArray();

        $part= "false";
        return view('reports.pasukanreport',compact('report','arraypasukans','part'));
        // return view('editor.preview-embellishment', $params);

    }

    public function viewreportpasukangraf($id)
    {
         $arraypasukans = Pasukan::select('id','parentId','nama','nama_kem')->get()->toArray();

         $pasukans =  Pasukan::find($id);

         $report =  $pasukans->nama;

         $part= "true";

         return view('reports.pasukanreport',compact('pasukans','report','arraypasukans','part'));
    }


    public function viewreportmarkasgraf($id)
    {
        // dd($id);
         $pasukans = Pasukan::all();

         $detailsTask = [];
         $arrayChild = [];
         $listTasks = [];

         $getArrayTop = Pasukan::all();

         foreach ($getArrayTop as $gat)
         {
             $getChildContent = Markas::where('pasukan_id', $gat->id)  ->get();

             $listTask[] = array(
                                 "ParentContent" => $gat->nama,
                                 "ParentId" => $gat->id,
                                 "ChildContent" => $getChildContent,
                         );
         }
         $detailsTask = $listTask;

         $namamarkas =  Markas::find($id);;

        //  $report =  $namamarkas->nama;

         return view('reports.pasukanreport',compact('pasukans','detailsTask','report'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd("show");
        //
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
    }
}
