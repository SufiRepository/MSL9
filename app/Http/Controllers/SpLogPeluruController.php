<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasukan;

use Hash;
use DB;

class SpLogPeluruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $TajukBlade = "LAPORAN STOK PELURU";

        $stokdepot  = DB::table('eis_special_log_peluru')->selectRaw("SUM(StokDepotTD) as value,JenisPeluru as category")
                            ->groupBy('category')
                            ->get()->ToArray();

        $stokpasukan  = DB::table('eis_special_log_peluru')->selectRaw("SUM(StokPasukan) as value,JenisPeluru as category")
                            ->groupBy('category')
                            ->get()->ToArray();
        //keupayaan
        $logpeluru =  DB::table('eis_special_log_peluru')->selectRaw("SUM(StokDepotTD) as stokdepottd,SUM(StokPasukan) as stokpasukan,SUM(KosStokSemasa) as kosstoksemasa,JenisPeluru")
                    ->groupBy('JenisPeluru')
                    ->get();

        // dd($sidebarmenudata[1]);
        return view('peluru.index'
            ,compact(
                'TajukBlade',
                'logpeluru','stokdepot','stokpasukan',
            )
        );
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
        //
        $data = DB::table('eis_special_log_peluru')->where("JenisPeluru",$id)
                    ->orderBy('id','DESC')
                    ->get();
        $jenispeluru = $id;
        // dd($jenispeluru);
        return view('peluru.show',compact(
                'data','jenispeluru'
                // 'taraf_kahwin',
                // 'agama',
                // 'jawatan'
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
