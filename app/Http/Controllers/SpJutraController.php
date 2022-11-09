<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasukan;
use App\Models\SpDukunganAir;

use Hash;
use DB;
use App\Models\SpJutra;

class SpJutraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $count_bekelanair = SpJutra::select('SUBKATEGORI_ASET')
                            ->where('KATEGORI','BEKALAN AIR' )
                            ->sum('PEG');

        $count_eod = SpJutra::select('SUBKATEGORI_ASET')
                            ->where('KATEGORI','EOD/IEDD' )
                            ->sum('PEG');


        $count_cbrne = SpJutra::select('SUBKATEGORI_ASET')
                        ->where('KATEGORI','CBRNe' )
                        ->sum('PEG');

        $count_periukapi= SpJutra::select('SUBKATEGORI_ASET')
                            ->where('KATEGORI','Peralatan Pemusnahan & Periuk Api' )
                            ->sum('PEG');

        $TajukBlade = "LAPORAN STOK JURUTERA";

        $boleh_guna  =SpJutra:: selectRaw("SUM(BG) as percentage,kategori as source")
                    ->groupBy('kategori')
                    ->get()->ToArray();

        $tidakboleh_guna  = SpJutra::selectRaw("SUM(tbg) as percentage,kategori as source")
                    ->groupBy('kategori')
                    ->get()->ToArray();

        $namauntukjenisbar =  SpJutra::select('kategori')
                    ->groupBy('kategori')
                    ->get();

        //keupayaan
        $hak =  SpJutra:: selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,kategori")
                    ->groupBy('kategori')
                    ->get();
        // dd($hak);
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

        // dd($hak);
        if (!empty($hakarray || $peganganarray ))
        {
            $tiadadata = 0;
        }else{
            $tiadadata = 'TIADA DATA';
        }

        if (!empty($boleh_guna ))
        {
            $bolehgunatiadadata = 0;
        }else{
            $bolehgunatiadadata = 'TIADA DATA';
        }

        if (!empty($tidakboleh_guna))
        {
            $tidakBolehtiadadata = 0;
        }else{
            $tidakBolehtiadadata = 'TIADA DATA';
        }

        return view('jutra.index',compact('TajukBlade','bolehgunatiadadata','tidakBolehtiadadata','count_bekelanair','count_eod','count_cbrne','count_periukapi','boleh_guna','tidakboleh_guna','namadalamarray','keupayaan','kesiagaan','hak') );
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //ahmad sufi
        //id taken is key+1, so we want to revert back to original key
        $id = $id-1;


        $senaraijutra =  SpJutra::groupBy('kategori')
                    ->get();

        $boleh_guna  =  SpJutra::where("kategori",$senaraijutra[$id]->kategori)
                        ->selectRaw("SUM(BG) as percentage,nama as source")
                        ->groupBy('nama')
                        ->having('percentage', '>', 0)
                        ->get()->ToArray();

        $tidakboleh_guna  =  SpJutra::where("kategori",$senaraijutra[$id]->kategori)
                            ->selectRaw("SUM(TBG) as percentage,nama as source")
                            ->having('percentage', '>', 0)
                            ->groupBy('nama')
                            ->get()->ToArray();


        $data = DB::table('special_log_jutra')->where("kategori",$senaraijutra[$id]->kategori)
                    ->orderBy('id','DESC')
                    ->get();

        $namakategori = $senaraijutra[$id]->kategori;

        return view('jutra.show',compact( 'data','namakategori','boleh_guna','tidakboleh_guna' ));
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

    public function spjutraBG($id)
    {
        $id = base64_decode($id);

        $data  = SpJutra:: where('kategori',$id)->get();


        $jenis =   $id;
        $status = "BOLEH GUNA";

        return view('SpecialReport.detailbgtbg',compact('data','jenis','status'));
    }
    public function spjutraTBG($id)
    {

        $id = base64_decode($id);

        $data  = SpJutra:: where('kategori',$id)->get();

        $jenis =   $id;
        $status = "TIDAK BOLEH GUNA";

        return view('SpecialReport.detailbgtbg',compact('data','jenis','status'));
    }

    public function subspjutraBG($id)
    {
        $id = base64_decode($id);

        $data  = SpJutra:: where('nama',$id)->get();

        $jenis =   $id;
        $status = "BOLEH GUNA";

        return view('SpecialReport.detailbgtbg',compact('data','jenis','status'));
    }
    public function subspjutraTBG($id)
    {
        $id = base64_decode($id);

        $data  = SpJutra:: where('nama',$id)->get();

        $jenis =   $id;
        $status = "TIDAK BOLEH GUNA";

        return view('SpecialReport.detailbgtbg',compact('data','jenis','status'));
    }


}
