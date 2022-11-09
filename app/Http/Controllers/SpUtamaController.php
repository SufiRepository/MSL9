<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasukan;
use App\Models\SpDukunganAir;
use App\Models\SpUtama;
use Hash;
use DB;

class SpUtamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $count_mobiliti = SpUtama::select('Nama')   
                                    ->where('KATEGORI','MOBILITI' )
                                    ->sum('Pegangan');

        $count_tembakan = SpUtama::select('Nama')   
                            ->where('KATEGORI','KUASA TEMBAKAN' )
                            ->sum('Pegangan');

        $count_komunikasi = SpUtama::select('Nama')   
                                ->where('KATEGORI','KOMUNIKASI' )
                                ->sum('Pegangan');

        $count_logistik= SpUtama::select('Nama')   
                                    ->where('KATEGORI','LOGISTIK' )
                                    ->sum('Pegangan');
                
        $TajukBlade = "LAPORAN STOK PERALATAN";

        $boleh_guna  =  SpUtama::selectRaw("SUM(BG) as percentage,kategori as source")
                    ->groupBy('kategori')
                    ->having('percentage', '>', 0)
                    ->get()->ToArray();

        $tidakboleh_guna  = SpUtama::selectRaw("SUM(TBG) as percentage,kategori as source")
                    ->having('percentage', '>', 0)
                    ->groupBy('kategori')
                    ->get()->ToArray();

        $namauntukjenisbar =  SpUtama::select('kategori')
                    ->groupBy('kategori')
                    ->get();

        //keupayaan
        $hak =  SpUtama::selectRaw("SUM(hak) as hak,SUM(pegangan) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,kategori")
                    ->groupBy('kategori')
                    ->get();
        $namadalamarray = [];
        foreach($namauntukjenisbar as $namadlmarray)
        {
            $namadalamarray[] = $namadlmarray->kategori;
        }
        $hakarray = [];
        $peganganarray  = [];
        foreach($hak as $datahak)
        {
            if ($datahak->hak > 0) {
                $jum = $datahak->hak;
            } else {
                $jum = "1";
            }

            $hakarray[] = $jum;
        }

        foreach($hak as $datapeg)
        {
            $peganganarray[] = $datapeg->pegangan;
        }

        $keupayaan=[];
        for($i=0; $i<sizeof($hakarray); $i++)
        {
            $keupayaan[$i]=round(($peganganarray[$i]/$hakarray[$i] ) * 100);
        }

        $BGarr = [];
        foreach($hak as $dataBG)
        {
            $BGarr[] = $dataBG->BG;
        }

        $kesiagaan=[];
        for($i=0; $i<sizeof($peganganarray); $i++)
        {
            $kesiagaan[$i]=round(($BGarr[$i]/$peganganarray[$i] ) * 100);
        }

        return view('spUtama.index',compact('TajukBlade','boleh_guna','tidakboleh_guna','namadalamarray','keupayaan','kesiagaan','hak','count_mobiliti','count_tembakan','count_komunikasi','count_logistik'));
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
        $boleh_guna  =  SpUtama::where("kategori",$id) 
                    ->selectRaw("SUM(BG) as percentage,Jenis as source")
                    ->groupBy('Jenis')
                    ->having('percentage', '>', 0)
                    ->get()->ToArray();

        $tidakboleh_guna  = SpUtama::where("kategori",$id)
                    ->selectRaw("SUM(TBG) as percentage,Jenis as source")
                    ->having('percentage', '>', 0)
                    ->groupBy('Jenis')
                    ->get()->ToArray();

        $namauntukjenisbar =  SpUtama::where("kategori",$id)
                    ->select('Jenis')
                    ->groupBy('Jenis')
                    ->get();


        //keupayaan
        $hak =  SpUtama::where("kategori",$id)
                    ->selectRaw("SUM(hak) as hak,SUM(pegangan) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,Jenis")
                    ->groupBy('Jenis')
                    ->get();

        $namadalamarray = [];
        foreach($namauntukjenisbar as $namadlmarray)
        {
            $namadalamarray[] = $namadlmarray->Jenis;
        }
        $hakarray = [];
        $peganganarray  = [];
        foreach($hak as $datahak)
        {
            if ($datahak->hak > 0) {
                $jum = $datahak->hak;
            } else {
                $jum = "1";
            }

            $hakarray[] = $jum;
        }

        foreach($hak as $datapeg)
        {
            $peganganarray[] = $datapeg->pegangan;
        }

        $keupayaan=[];
        for($i=0; $i<sizeof($hakarray); $i++)
        {
            $keupayaan[$i]=round(($peganganarray[$i]/$hakarray[$i] ) * 100);
        }

        $BGarr = [];
        foreach($hak as $dataBG)
        {
            $BGarr[] = $dataBG->BG;
        }

        $kesiagaan=[];
        for($i=0; $i<sizeof($peganganarray); $i++)
        {
            $kesiagaan[$i]=round(($BGarr[$i]/$peganganarray[$i] ) * 100);
        }

        $namakategori = $id;
        return view('spUtama.show',compact('namakategori','boleh_guna','tidakboleh_guna','hak','namadalamarray','keupayaan','kesiagaan','hak',));
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

    public function sputamaBG($id)
    {
        // dd($id);
        $data  = SpUtama:: where('kategori',$id)->get();

        $jenis =   $id;     
        $status = "BOLEH GUNA";    

        return view('spUtama.detailbgtbg',compact('data','jenis','status'));
    }
    public function sputamaTBG($id)
    {
        $data  = SpUtama:: where('kategori',$id)->get();

        $jenis =   $id;     
        $status = "TIDAK BOLEH GUNA";    

        return view('spUtama.detailbgtbg',compact('data','jenis','status'));
    }

    public function subsputamaBG($id)
    {
        // dd($id);
        $data  = SpUtama:: where('jenis',$id)->get();

        $jenis =   $id;     
        $status = "BOLEH GUNA";    

        // dd(\json_encode($data));

        return view('spUtama.detailbgtbg',compact('data','jenis','status'));
    }
    public function subsputamaTBG($id)
    {
        $data  = SpUtama:: where('jenis',$id)->get();

        $jenis =   $id;     
        $status = "TIDAK BOLEH GUNA";    

        return view('spUtama.detailbgtbg',compact('data','jenis','status'));
    }


}
