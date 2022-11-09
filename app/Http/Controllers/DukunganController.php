<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ItemPasukan;
use App\Models\SnapPasukan;
use App\Models\Pasukan;

class DukunganController extends Controller
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

    public function dukungan($id)
    {
       
        $caripasukan = Pasukan::find($id);

        $unit = $caripasukan->nama;
        $pasukan_id = $caripasukan->id;
                
        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $count_darat = SnapPasukan::select('id')   
                                        ->where('SUBKATEGORI_ASET','Mobiliti darat' )
                                        ->sum('PEG');

            $count_perairan = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('SUBKATEGORI_ASET','Mobiliti Perairan' )
                                        ->sum('PEG');

            $count_udara = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('SUBKATEGORI_ASET','Mobiliti Udara' )
                                        ->sum('PEG');

            $boleh_guna  = SnapPasukan:: where('kategori_aset','Aset Dukungan' )
                                    ->selectRaw("SUM(BG) as percentage,SUBKATEGORI_ASET as source")
                                    ->groupBy('SUBKATEGORI_ASET')
                                    ->get()->ToArray();

            $tidakboleh_guna  = SnapPasukan:: where('kategori_aset','Aset Dukungan' )
                                    ->selectRaw("SUM(tbg) as percentage,SUBKATEGORI_ASET as source")
                                    ->groupBy('SUBKATEGORI_ASET')
                                    ->get()->ToArray();

            $namauntukjenisbar =  SnapPasukan:: join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                            -> where('kategori_aset','Aset Dukungan' )
                                            ->select('SUBKATEGORI_ASET')
                                            ->groupBy('SUBKATEGORI_ASET')
                                            ->orderBy('orderno', 'asc')
                                            ->get();
                                 //keupayaan
            $hak =  SnapPasukan::join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                 -> where('kategori_aset','Aset Dukungan' )
                                ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,SUBKATEGORI_ASET")
                                ->groupBy('SUBKATEGORI_ASET')
                                ->orderBy('orderno', 'asc')
                                ->get();
        }
        else{
            $count_darat = SnapPasukan::select('id')   
                                        ->where('IDPASUKAN',$id)
                                        ->where('SUBKATEGORI_ASET','Mobiliti darat' )
                                        ->sum('PEG');

            $count_perairan = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('IDPASUKAN',$id)
                                        ->where('SUBKATEGORI_ASET','Mobiliti Perairan' )
                                        ->sum('PEG');

            $count_udara = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('IDPASUKAN',$id)
                                        ->where('SUBKATEGORI_ASET','Mobiliti Udara' )
                                        ->sum('PEG');

            $boleh_guna  = SnapPasukan:: where('kategori_aset','Aset Dukungan' )
                                        ->where('IDPASUKAN',$id)
                                        ->selectRaw("SUM(BG) as percentage,SUBKATEGORI_ASET as source")
                                        ->groupBy('SUBKATEGORI_ASET')
                                        ->get()->ToArray();

            $tidakboleh_guna  = SnapPasukan:: where('kategori_aset','Aset Dukungan' )
                                            ->where('IDPASUKAN',$id)
                                            ->selectRaw("SUM(tbg) as percentage,SUBKATEGORI_ASET as source")
                                            ->groupBy('SUBKATEGORI_ASET')
                                            ->get()->ToArray();

            $namauntukjenisbar =  SnapPasukan:: where('kategori_aset','Aset Dukungan' )
                                            ->where('IDPASUKAN',$id)
                                            ->select('SUBKATEGORI_ASET')
                                            ->groupBy('SUBKATEGORI_ASET')
                                            ->get();
                                 //keupayaan
        $hak =  SnapPasukan::where('kategori_aset','Aset Dukungan' )
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

        //buat checking elemnet kosng
    
    
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

        return view('dukungans.dukungan',compact('caripasukan','bolehgunatiadadata','tiadadata','tidakBolehtiadadata','unit','pasukan_id','count_darat','count_perairan','count_udara','boleh_guna','tidakboleh_guna','namadalamarray','keupayaan','kesiagaan','pasukan','divisyen','formasi','briged','hak'));

    }
    public function darat($id)
    {
        
        $caripasukan = Pasukan::find($id);

        $unit = $caripasukan->nama;
        $pasukan_id = $caripasukan->id;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $count_kjb  = SnapPasukan:: select('id') ->where('jenis','kjb')->count();
            $count_kjc  = SnapPasukan:: select('id') ->where('jenis','kjc')->count();

            $boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Mobiliti Darat' )
                                    ->selectRaw("SUM(BG) as percentage,jenis as source")
                                    ->groupBy('jenis')
                                    ->get()->ToArray();

            $tidakboleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Mobiliti Darat' )
                                    ->selectRaw("SUM(tbg) as percentage,jenis as source")
                                    ->groupBy('jenis')
                                    ->get()->ToArray();

            $namauntukjenisbar =  SnapPasukan:: where('SUBKATEGORI_ASET','Mobiliti Darat' )
                                            ->select('jenis')
                                            ->groupBy('jenis')
                                            ->get();
                                 //keupayaan
            $hak =  SnapPasukan::where('SUBKATEGORI_ASET','Mobiliti Darat' )
                                ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,jenis")
                                ->groupBy('jenis')
                                ->get();
        }
        else{
            $count_kjb  = SnapPasukan:: select('id') ->where('jenis','kjb')->count();
            $count_kjc  = SnapPasukan:: select('id') ->where('jenis','kjc')->count();

            $boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Mobiliti Darat' )
                                        ->where('IDPASUKAN',$id)
                                        ->selectRaw("SUM(BG) as percentage,jenis as source")
                                        ->groupBy('jenis')
                                        ->get()->ToArray();

            $tidakboleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Mobiliti Darat' )
                                            ->where('IDPASUKAN',$id)
                                            ->selectRaw("SUM(tbg) as percentage,jenis as source")
                                            ->groupBy('jenis')
                                            ->get()->ToArray();

            $namauntukjenisbar =  SnapPasukan:: where('SUBKATEGORI_ASET','Mobiliti Darat' )
                                            ->where('IDPASUKAN',$id)
                                            ->select('jenis')
                                            ->groupBy('jenis')
                                            ->get();
                                 //keupayaan
            $hak =  SnapPasukan::where('SUBKATEGORI_ASET','Aset Dukungan' )
                                ->where('IDPASUKAN',$id)
                                ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,jenis")
                                ->groupBy('jenis')
                                ->get();
         }
       
        $namadalamarray = [];

        foreach($namauntukjenisbar as $namadlmarray) 
        {
            $namadalamarray[] = $namadlmarray->jenis;
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
               
        return view('dukungans.darat',compact('caripasukan','tidakBolehtiadadata','tiadadata','bolehgunatiadadata','pasukan_id','unit','count_kjb','count_kjc','boleh_guna','tidakboleh_guna','namadalamarray','keupayaan','kesiagaan','pasukan','divisyen','formasi','briged','hak'));
    }
   
    public function perairan($id)
    {
        // dd("treelist");

        $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;
        
        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){

            $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti perairan' )
            ->whereIn('status_siaga',['BG','BP','BDG'])
            ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
            ->groupBy('kategori_utama')
            ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti perairan' ) 
            ->whereIn('status_siaga',['TBG','TBDG'])
            ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
            ->groupBy('kategori_utama')
            ->get()->ToArray();

        }else{

            $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti perairan' ) ->where('IDPASUKAN',$id)
            ->whereIn('status_siaga',['BG','BP','BDG'])
            ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
            ->groupBy('kategori_utama')
            ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti perairan' ) ->where('IDPASUKAN',$id)
            ->whereIn('status_siaga',['TBG','TBDG'])
            ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
            ->groupBy('kategori_utama')
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

        return view('dukungans.perairan',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }
    public function udara($id)
    {
        $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;
        
        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){

            $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti udara' )
                                    ->whereIn('status_siaga',['BG','BP','BDG'])
                                    ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                    ->groupBy('kategori_utama')
                                    ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti udara' )
                                    ->whereIn('status_siaga',['TBG','TBDG'])
                                    ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                    ->groupBy('kategori_utama')
                                    ->get()->ToArray();

        }else{
            $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti udara' )  ->where('IDPASUKAN',$id)
                                    ->whereIn('status_siaga',['BG','BP','BDG'])
                                    ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                    ->groupBy('kategori_utama')
                                    ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti udara' )  ->where('IDPASUKAN',$id)
                                    ->whereIn('status_siaga',['TBG','TBDG'])
                                    ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                    ->groupBy('kategori_utama')
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

        // dd("treelist");
        return view('dukungans.udara',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }

    public function kjb($id)
    {
        $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;
        
        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti udara' )
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti udara' )
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        }
        else{

         $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti udara' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','Mobiliti udara' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
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

        // dd( $tiadadata);
        $namapage = 'KJB';

        return view('dukungans.kjb',compact('caripasukan','namapage','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }
    public function kjc($id)
    {
        $caripasukan = Pasukan::find($id);

        $unit = $caripasukan->nama;
        $pasukan_id = $caripasukan->id;
       
        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $boleh_guna  = ItemPasukan:: where('jenis','kjc' )
                                        ->whereIn('status_siaga',['BG','BP','BDG'])
                                        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                        ->groupBy('kategori_utama')
                                        ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan:: where('jenis','kjc' )
                                                ->whereIn('status_siaga',['TBG','TBDG'])
                                                ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                                ->groupBy('kategori_utama')
                                                ->get()->ToArray();
        }else{
            $boleh_guna  = ItemPasukan:: where('jenis','kjc' ) 
                                        ->where('IDPASUKAN',$id)
                                        ->whereIn('status_siaga',['BG','BP','BDG'])
                                        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                        ->groupBy('kategori_utama')
                                        ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan:: where('jenis','kjc' ) 
                                        ->where('IDPASUKAN',$id)
                                        ->whereIn('status_siaga',['TBG','TBDG'])
                                        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                        ->groupBy('kategori_utama')
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
        $namapage = 'KJC';
        
        return view('dukungans.kjb',compact('caripasukan','namapage', 'bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }

}
