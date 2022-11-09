<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemPasukan;
use App\Models\SnapPasukan;
use App\Models\Pasukan;

class KomunikasiController extends Controller
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

    public function komunikasi($id){
        $caripasukan = Pasukan::find($id);

        $unit = $caripasukan->nama;
        $pasukan_id = $caripasukan->id;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){

            $count_manpack = SnapPasukan::select('id')
                            ->where('SUBKATEGORI_ASET','Radio ManPack' )
                            ->sum('PEG');

            $count_vehicular = SnapPasukan::select('id')
                        ->where('SUBKATEGORI_ASET','Radio Vehicular' )
                        ->sum('PEG');

            $count_Armd_Comfit = SnapPasukan::select('id')
                        ->where('SUBKATEGORI_ASET','Armd Comfit' )
                        ->sum('PEG');

            $boleh_guna  = SnapPasukan:: where('kategori_aset','Komunikasi' )
                                    ->selectRaw("SUM(BG) as percentage,SUBKATEGORI_ASET as source")
                                    ->groupBy('SUBKATEGORI_ASET')
                                    ->get()
                                    // ->having('percentage', '>', 0)
                                    ->ToArray();

            $tidakboleh_guna  = SnapPasukan:: where('kategori_aset','Komunikasi' )
                                    ->selectRaw("SUM(tbg) as percentage,SUBKATEGORI_ASET as source")
                                    ->groupBy('SUBKATEGORI_ASET')
                                    // ->having('percentage', '>', 0)
                                    ->get()
                                    ->ToArray();

            $namauntukjenisbar =  SnapPasukan::join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                            -> where('kategori_aset','Komunikasi' )
                                            ->select('SUBKATEGORI_ASET')
                                            ->groupBy('SUBKATEGORI_ASET')
                                            ->orderBy('orderno', 'asc')
                                            ->get();

            $hak =  SnapPasukan::join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                    -> where('kategori_aset','Komunikasi' )
                                    ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,SUBKATEGORI_ASET")
                                    ->groupBy('SUBKATEGORI_ASET')
                                    ->orderBy('orderno', 'asc')

                                    ->get();
        }else{
            $count_manpack = SnapPasukan::select('id')
                                        ->where('IDPASUKAN',$id)
                                        ->where('SUBKATEGORI_ASET','manpack' )
                                        ->sum('PEG');

            $count_vehicular = SnapPasukan::select('SUBKATEGORI_ASET')
                                            ->where('IDPASUKAN',$id)
                                            ->where('SUBKATEGORI_ASET','vehicular' )
                                            ->sum('PEG');

            $count_Armd_Comfit = SnapPasukan::select('id')
                                            ->where('IDPASUKAN',$id)
                                            ->where('SUBKATEGORI_ASET','Armd Comfit' )
                                            ->sum('PEG');

            $boleh_guna  = SnapPasukan:: join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                         ->where('kategori_aset','Komunikasi' )
                                        ->where('IDPASUKAN',$id)
                                        ->selectRaw("SUM(BG) as percentage,SUBKATEGORI_ASET as source")
                                        ->groupBy('SUBKATEGORI_ASET')
                                        ->orderBy('orderno', 'asc')
                                        // ->having('percentage', '>', 0)
                                        ->get()->ToArray();

            $tidakboleh_guna  = SnapPasukan:: join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                             ->where('kategori_aset','Komunikasi' )
                                            ->where('IDPASUKAN',$id)
                                            ->selectRaw("SUM(tbg) as percentage,SUBKATEGORI_ASET as source")
                                            ->groupBy('SUBKATEGORI_ASET')
                                            // ->having('percentage', '>', 0)
                                            ->orderBy('orderno', 'asc')
                                            ->get()->ToArray();

            $namauntukjenisbar =  SnapPasukan:: where('kategori_aset','Komunikasi' )
                                                ->where('IDPASUKAN',$id)
                                                ->select('SUBKATEGORI_ASET')
                                                ->groupBy('SUBKATEGORI_ASET')
                                                ->get();

            $hak =  SnapPasukan::where('kategori_aset','Komunikasi' )
                                ->where('IDPASUKAN',$id)
                                ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,SUBKATEGORI_ASET")
                                ->groupBy('SUBKATEGORI_ASET')
                                ->get();
        }

        $namadalamarray = [];

        foreach($namauntukjenisbar as $namadlmarray)
        {
            $namadalamarray[] = $namadlmarray->SUBKATEGORI_ASET;
        }

        $hakarray = [];
        $peganganarray  = [];
        $jum = 0;

        foreach($hak as $datahak)
        {
            if ($datahak->hak > 0) {
                $jum = $datahak->hak;
            } else {
                $jum = "1";
            }

            $hakarray[] = $jum;
        }

        foreach($hak as $datahak)
        {
            if ($datahak->pegangan > 0) {
                $jumpeg = $datahak->pegangan;
            } else {
                $jumpeg = "1";
            }

            $peganganarray[] = $jumpeg;
        }

        // dd($peganganarray);

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

        if (!empty($hakarray || $peganganarray ))
        {
            $tiadadata = 0;
        }else{

            $tiadadata = 'TIADA DATA';
        }

        if (!empty($boleh_guna))
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
        return view('komunikasi.komunikasi',compact('caripasukan','tiadadata','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','count_manpack','count_vehicular','count_Armd_Comfit','boleh_guna','tidakboleh_guna','namadalamarray','keupayaan','kesiagaan','pasukan','divisyen','formasi','briged','hak'));
    }

    public function manpack($id)
    {
        $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;

        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){


            $boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Radio ManPack' )
                                    ->selectRaw("SUM(BG) as percentage,KATEGORI_UTAMA as source")
                                    ->groupBy('KATEGORI_UTAMA')
                                    // ->having('percentage', '>', 0)
                                    ->get()->ToArray();

            $tidakboleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Radio ManPack' )
                                    ->selectRaw("SUM(tbg) as percentage,KATEGORI_UTAMA as source")
                                    ->groupBy('KATEGORI_UTAMA')
                                    // ->having('percentage', '>', 0)
                                    ->get()->ToArray();

        }else{


            $boleh_guna  = SnapPasukan:: join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                         ->where('SUBKATEGORI_ASET','Radio ManPack' )
                                        ->where('IDPASUKAN',$id)
                                        ->selectRaw("SUM(BG) as percentage,SUBKATEGORI_ASET as source")
                                        ->groupBy('KATEGORI_UTAMA')
                                        ->orderBy('orderno', 'asc')
                                        ->get()->ToArray();

            $tidakboleh_guna  = SnapPasukan:: join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                             ->where('SUBKATEGORI_ASET','Radio ManPack' )
                                            ->where('IDPASUKAN',$id)
                                            ->selectRaw("SUM(tbg) as percentage,SUBKATEGORI_ASET as source")
                                            ->groupBy('KATEGORI_UTAMA')
                                            ->orderBy('orderno', 'asc')
                                            ->get()->ToArray();
        }
        if (!empty($boleh_guna))
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

        return view('komunikasi.manpack',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidakboleh_guna','pasukan','divisyen','formasi','briged'));

    }
    public function vehicular($id)
    {
        $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;
        $unit = $caripasukan->nama;


        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){

            $boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Radio Vehicular' )
                                    ->selectRaw("SUM(BG) as percentage,KATEGORI_UTAMA as source")
                                    ->groupBy('KATEGORI_UTAMA')
                                    // ->having('percentage', '>', 0)
                                    ->get()->ToArray();

            $tidak_boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Radio Vehicular' )
                                    ->selectRaw("SUM(tbg) as percentage,KATEGORI_UTAMA as source")
                                    ->groupBy('KATEGORI_UTAMA')
                                    // ->having('percentage', '>', 0)
                                    ->get()->ToArray();

        }else{
            $boleh_guna  = SnapPasukan::where('SUBKATEGORI_ASET','Radio Vehicular' )
                                    ->selectRaw("SUM(BG) as percentage,KATEGORI_UTAMA as source")
                                    ->where('IDPASUKAN',$id)
                                    ->groupBy('KATEGORI_UTAMA')
                                    // ->having('percentage', '>', 0)
                                    ->get()->ToArray();

            $tidak_boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Radio Vehicular' )
                                            ->selectRaw("SUM(tbg) as percentage,KATEGORI_UTAMA as source")
                                            ->where('IDPASUKAN',$id)
                                            ->groupBy('KATEGORI_UTAMA')
                                            // ->having('percentage', '>', 0)
                                            ->get()->ToArray();
        }

        if (!empty($boleh_guna))
        {
            $bolehgunatiadadata = 0;
        }else{

            $bolehgunatiadadata = 'TIADA DATA';
        }

        if (!empty($tidak_boleh_guna))
        {
            $tidakBolehtiadadata = 0;
        }else{

            $tidakBolehtiadadata = 'TIADA DATA';
        }


        return view('komunikasi.vehicular',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }
    public function ArmdComfit($id)
    {
        $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;

        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){

            $boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Armd Comfit' )
                                    ->selectRaw("SUM(BG) as percentage,KATEGORI_UTAMA as source")
                                    ->groupBy('KATEGORI_UTAMA')
                                    // ->having('percentage', '>', 0)
                                    ->get()->ToArray();

            $tidak_boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Armd Comfit' )
                                    ->selectRaw("SUM(tbg) as percentage,KATEGORI_UTAMA as source")
                                    ->groupBy('KATEGORI_UTAMA')
                                    // ->having('percentage', '>', 0)
                                    ->get()->ToArray();

        }else{
            $boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Armd Comfit' )
            ->selectRaw("SUM(BG) as percentage,KATEGORI_UTAMA as source")
            ->where('IDPASUKAN',$id)
            ->groupBy('KATEGORI_UTAMA')
            // ->having('percentage', '>', 0)
            ->get()->ToArray();

            $tidak_boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Armd Comfit' )
            ->selectRaw("SUM(tbg) as percentage,KATEGORI_UTAMA as source")
            ->where('IDPASUKAN',$id)
            ->groupBy('KATEGORI_UTAMA')
            // ->having('percentage', '>', 0)
            ->get()->ToArray();

        }

        if (!empty($boleh_guna))
        {
            $bolehgunatiadadata = 0;
        }else{

            $bolehgunatiadadata = 'TIADA DATA';
        }

        if (!empty($tidak_boleh_guna))
        {
            $tidakBolehtiadadata = 0;
        }else{

            $tidakBolehtiadadata = 'TIADA DATA';
        }

        return view('komunikasi.armdcomfit',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }

    public function komunikasiBG($parameter1,$parameter2,$parameter3){

        if($parameter2 == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN')
            ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.PEG','snap_pasukan.HAK','snap_pasukan.BG')
            ->where('SUBKATEGORI_ASET',$parameter1 )
            ->get();
        }else{
            $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN')
            ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.PEG','snap_pasukan.HAK','snap_pasukan.BG')
            ->where('SUBKATEGORI_ASET',$parameter1 )
            ->where('IDPASUKAN',$parameter2)
            ->get();
        }

        $jenis =   $parameter1;
        $status = "BOLEH GUNA";
        $previous = $parameter3;

        return view('komunikasi.detail',compact('data','jenis','status','previous'));
    }

    public function komunikasiTBG($parameter1,$parameter2,$parameter3){

        if($parameter2 == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN')
            ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.PEG','snap_pasukan.HAK','snap_pasukan.TBG')
            ->where('SUBKATEGORI_ASET',$parameter1 )
            ->get();
        }else{
            $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN')
            ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.PEG','snap_pasukan.HAK','snap_pasukan.TBG')
            ->where('SUBKATEGORI_ASET',$parameter1 )
            ->where('IDPASUKAN',$parameter2)
            ->get();
        }

        $jenis =   $parameter1;
        $status = "TIDAK BOLEH GUNA";
        $previous = $parameter3;
        return view('komunikasi.detail',compact('data','jenis','status','previous'));
    }

    public function SubkomunikasiBG($parameter1,$parameter2,$parameter3){

       $parameter1 = base64_decode($parameter1);

        if($parameter2 == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN')
            ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.PEG','snap_pasukan.HAK','snap_pasukan.BG')
            ->where('KATEGORI_UTAMA',$parameter1 )
            ->get();
        }
        else{
            $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN')
            ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.PEG','snap_pasukan.HAK','snap_pasukan.BG')
            ->where('KATEGORI_UTAMA',$parameter1 )
            ->where('IDPASUKAN',$parameter2)
            ->get();
        }


        $jenis =   $parameter1;
        $status = "BOLEH GUNA";
        $previous = $parameter3;
        return view('komunikasi.detail',compact('data','jenis','status','previous'));
    }

    public function SubkomunikasiTBG($parameter1,$parameter2,$parameter3){

        $parameter1 = base64_decode($parameter1);

        if($parameter2 == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN')
            ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.BG','snap_pasukan.HAK','snap_pasukan.PEG','snap_pasukan.TBG')
            ->where('KATEGORI_UTAMA',$parameter1 )
            ->get();

        }else{
            $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN')
            ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.HAK','snap_pasukan.PEG','snap_pasukan.BG')
            ->where('KATEGORI_UTAMA',$parameter1 )
            ->where('IDPASUKAN',$parameter2)
            ->get();
        }

        $jenis =   $parameter1;
        $status = "TIDAK BOLEH GUNA";
        $previous = $parameter3;
        return view('komunikasi.detail',compact('data','jenis','status','previous'));
    }

}
