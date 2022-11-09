<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pasukan;
use App\Models\SpDukunganAir;
class SpDukunganAirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    public function DukunganAir($id)
    {
        $TajukBlade = "LAPORAN STOK DUKUNGAN AIR";

        $caripasukan = Pasukan::find($id);

        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        
        $count_bottempur = SpDukunganAir::select('id')   
                        ->where('KATEGORI','BOT TEMPUR' )
                        ->sum('PEG');

        $count_obm = SpDukunganAir::select('SUBKATEGORI_ASET')   
                        ->where('KATEGORI','OBM' )
                        ->sum('PEG');

        $boleh_guna  = SpDukunganAir::selectRaw("SUM(BG) as percentage,kategori as source")
                                     ->groupBy('kategori')
                                     ->get()->ToArray();

        $tidakboleh_guna  = SpDukunganAir::selectRaw("SUM(tbg) as percentage,kategori as source")
                                        ->groupBy('kategori')
                                        ->get()->ToArray();

        $namauntukjenisbar =  SpDukunganAir:: select('kategori')
                                            ->groupBy('kategori')
                                            ->get();

        $namadalamarray = [];

        foreach($namauntukjenisbar as $namadlmarray)
        {
        $namadalamarray[] = $namadlmarray->kategori;
        }

        //keupayaan
        $hak =  SpDukunganAir::selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,kategori")
                            ->groupBy('kategori')
                            ->get();

        $hakarray = [];

        $peganganarray  = [];

        foreach($hak as $datahak)
        {
            $hakarray[] = $datahak->hak;
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

        return view('SpecialReport.DukunganAir',compact('TajukBlade','count_bottempur','count_obm','unit','boleh_guna','tidakboleh_guna','namadalamarray','keupayaan','kesiagaan','pasukan','divisyen','formasi','briged','hak'));
    }

    public function ListDukungAir($id)
    {
     
        $boleh_guna  =  SpDukunganAir::where("kategori",$id) 
                            ->selectRaw("SUM(BG) as percentage,nama as source")
                            ->groupBy('nama')
                            ->having('percentage', '>', 0)
                            ->get()->ToArray();

        $tidakboleh_guna  = SpDukunganAir::where("kategori",$id)
                ->selectRaw("SUM(TBG) as percentage,nama as source")
                ->having('percentage', '>', 0)
                ->groupBy('nama')
                ->get()->ToArray();

        $namauntukjenisbar =  SpDukunganAir::where("kategori",$id)
                ->select('nama')
                ->groupBy('nama')
                ->get();


        //keupayaan
        $hak =  SpDukunganAir::where("kategori",$id)
                ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,nama")
                ->groupBy('nama')
                ->get();

        $namadalamarray = [];
        foreach($namauntukjenisbar as $namadlmarray)
        {
        $namadalamarray[] = $namadlmarray->nama;
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
        return view('SpecialReport.show',compact('namakategori','boleh_guna','tidakboleh_guna','hak','namadalamarray','keupayaan','kesiagaan','hak',));
    }

    public function spdukunganairBG($id)
    {
        $data  = SpDukunganAir:: where('kategori',$id)->get();


        $jenis =   $id;     
        $status = "BOLEH GUNA";    

        return view('SpecialReport.detailbgtbg',compact('data','jenis','status'));
    }
    public function spdukunganairTBG($id)
    {
        $data  = SpDukunganAir:: where('kategori',$id)->get();

        $jenis =   $id;     
        $status = "TIDAK BOLEH GUNA";    

        return view('SpecialReport.detailbgtbg',compact('data','jenis','status'));
    }

    public function subspdukunganairBG($id)
    {
        // dd($id);
        $data  = SpDukunganAir:: where('nama',$id)->get();
        $jenis =   $id;     
        $status = "BOLEH GUNA";    


        return view('SpecialReport.detailbgtbg',compact('data','jenis','status'));
    }
    public function subspdukunganairTBG($id)
    {
        
        $data  = SpDukunganAir:: where('nama',$id)->get();
        $jenis =   $id;     
        $status = "TIDAK BOLEH GUNA";    

        return view('SpecialReport.detailbgtbg',compact('data','jenis','status'));
    }

}
