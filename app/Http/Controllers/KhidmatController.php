<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemPasukan;
use App\Models\SnapPasukan;
use App\Models\Pasukan;

class KhidmatController extends Controller
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
    public function khidmat($id)
    {  $caripasukan = Pasukan::find($id);

        $unit = $caripasukan->nama;
        $pasukan_id = $caripasukan->id;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){

            $count_persendirian = SnapPasukan::select('SUBKATEGORI_ASET')   
                                            ->where('SUBKATEGORI_ASET','persendirian' )
                                            ->sum('PEG');

            $count_peluru = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('SUBKATEGORI_ASET','peluru' )
                                        ->sum('PEG');

            $count_letupan = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('SUBKATEGORI_ASET','letupan' )
                                        ->sum('PEG');

            $count_jurutera = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('SUBKATEGORI_ASET','jurutera' )
                                        ->sum('PEG');

            $count_preventif = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('SUBKATEGORI_ASET','preventif' )
                                        ->sum('PEG');

            $count_rangsum = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('SUBKATEGORI_ASET','Rangsum' )
                                        ->sum('PEG');
                
            $count_ict = SnapPasukan::select('SUBKATEGORI_ASET')   
                                    ->where('SUBKATEGORI_ASET','ict' )
                                    ->sum('PEG');

            $boleh_guna  = SnapPasukan:: where('kategori_aset','Khidmat' )
                                        ->whereNotIn('SUBKATEGORI_ASET',['Rangsum'])
                                        ->selectRaw("SUM(bg) as percentage,SUBKATEGORI_ASET as source")
                                        ->groupBy('SUBKATEGORI_ASET')
                                        ->having('percentage', '>', 0)
                                        ->get()->ToArray();

            $tidakboleh_guna  = SnapPasukan:: where('kategori_aset','Khidmat' )
                                            // ->where('TBG' > '0')
                                            ->whereNotIn('SUBKATEGORI_ASET',['Rangsum'])
                                            ->selectRaw("SUM(tbg) as percentage,SUBKATEGORI_ASET as source")
                                            ->groupBy('SUBKATEGORI_ASET')
                                            ->having('percentage', '>', 0)
                                            ->get()->ToArray();

            $namauntukjenisbar =  SnapPasukan:: join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                                ->where('kategori_aset','Khidmat' )
                                                ->select('SUBKATEGORI_ASET')
                                                ->groupBy('ut_subkategori_aset.nama')
                                                ->orderBy('orderno', 'asc')
                                                ->get();
                                               
            $hak =  SnapPasukan:: join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                ->where('kategori_aset','Khidmat' )
                                ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,SUBKATEGORI_ASET")
                                ->groupBy('SUBKATEGORI_ASET')
                                ->orderBy('orderno', 'asc')
                                ->get();
        }else{

            $count_persendirian = SnapPasukan::select('SUBKATEGORI_ASET')   
                                            ->where('SUBKATEGORI_ASET','persendirian' )
                                            ->where('IDPASUKAN',$id)
                                            ->sum('PEG');

            $count_peluru = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('SUBKATEGORI_ASET','peluru' )
                                        ->where('IDPASUKAN',$id)
                                        ->sum('PEG');

            $count_letupan = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('SUBKATEGORI_ASET','letupan' )
                                        ->where('IDPASUKAN',$id)
                                        ->sum('PEG');

            $count_jurutera = SnapPasukan::select('SUBKATEGORI_ASET')   
                                        ->where('SUBKATEGORI_ASET','jurutera' )
                                        ->where('IDPASUKAN',$id)
                                        ->sum('PEG');

            $count_preventif = SnapPasukan::select('SUBKATEGORI_ASET')   
                                            ->where('SUBKATEGORI_ASET','preventif' )
                                            ->where('IDPASUKAN',$id)
                                            ->sum('PEG');

            $count_rangsum = SnapPasukan::select('SUBKATEGORI_ASET')   
                                            ->where('SUBKATEGORI_ASET','Rangsum' )
                                            ->where('IDPASUKAN',$id)
                                            ->sum('PEG');

            $count_ict = SnapPasukan::select('SUBKATEGORI_ASET')   
                                            ->where('SUBKATEGORI_ASET','ict' )
                                            ->where('IDPASUKAN',$id)
                                            ->sum('PEG');
            $boleh_guna  = SnapPasukan:: where('kategori_aset','Khidmat' )
                                            ->whereNotIn('SUBKATEGORI_ASET',['Rangsum'])
                                            ->selectRaw("SUM(bg) as percentage,SUBKATEGORI_ASET as source")
                                            ->where('IDPASUKAN',$id)
                                            ->groupBy('SUBKATEGORI_ASET')
                                            ->having('percentage', '>', 0)
                                            ->get()->ToArray();
    
           $tidakboleh_guna  = SnapPasukan:: where('kategori_aset','Khidmat' )
                                                ->whereNotIn('SUBKATEGORI_ASET',['Rangsum'])
                                                ->selectRaw("SUM(tbg) as percentage,SUBKATEGORI_ASET as source")
                                                ->where('IDPASUKAN',$id)
                                                ->groupBy('SUBKATEGORI_ASET')
                                                ->having('percentage', '>', 0)
                                                ->get()->ToArray();
    

                                            
            $namauntukjenisbar =  SnapPasukan:: join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                            ->where('kategori_aset','Khidmat' )
                                            ->select('SUBKATEGORI_ASET')
                                            ->groupBy('ut_subkategori_aset.nama')
                                            ->orderBy('orderno', 'asc')
                                            ->get();

            $namauntukjenisbar =  SnapPasukan::  where('kategori_aset','Khidmat' )
                                                ->where('IDPASUKAN',$id)
                                                ->select('jenis')
                                                ->groupBy('jenis')
                                                ->get();
            //keupayaan
            $hak =  SnapPasukan::where('kategori_aset','Khidmat' ) 
                                ->where('IDPASUKAN',$id)
                                ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,jenis")
                                ->groupBy('jenis')
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

        return view('khidmat.khidmat',compact('caripasukan','bolehgunatiadadata','tiadadata','tidakBolehtiadadata','pasukan_id','count_persendirian','count_peluru','count_letupan','count_jurutera','count_preventif','count_rangsum','count_ict','unit','boleh_guna','tidakboleh_guna','namadalamarray','keupayaan','kesiagaan','pasukan','divisyen','formasi','briged','hak'));
    }

    public function persendirian($id)
    { 
        $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;
        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $count_helmet           = SnapPasukan:: select('id') ->where('jenis','helmet')->count();
            $count_kasuttempur      = SnapPasukan:: select('id') ->where('jenis','kasuttempur')->count();
            $count_topiloreng       = SnapPasukan:: select('id') ->where('jenis','topiloreng')->count();
            $count_webbinglengkap   = SnapPasukan:: select('id') ->where('jenis','webbinglengkap')->count();
            $count_jerseypullover   = SnapPasukan:: select('id') ->where('jenis','jerseypullover')->count();
            $count_stokinghijau     = SnapPasukan:: select('id') ->where('jenis','stokinhijau')->count();
            $count_bajutempur       = SnapPasukan:: select('id') ->where('jenis','bajutempur')->count();
            $count_inner            = SnapPasukan:: select('id') ->where('jenis','inner')->count();

            $boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','persendirian' )
                                    ->selectRaw("SUM(BG) as percentage,jenis as source")
                                    ->groupBy('jenis')
                                    ->get()->ToArray();

            $tidakboleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','persendirian' )
                                    ->selectRaw("SUM(tbg) as percentage,jenis as source")
                                    ->groupBy('jenis')
                                    ->get()->ToArray();

            $namauntukjenisbar =  SnapPasukan:: where('SUBKATEGORI_ASET','persendirian' )
                                            ->select('jenis')
                                            ->groupBy('jenis')
                                            ->get();
    
            $hak =  SnapPasukan::where('SUBKATEGORI_ASET','persendirian' )
                                ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,jenis")
                                ->groupBy('jenis')
                                ->get();
        }
        else{
            $count_helmet           = SnapPasukan:: select('id') ->where('jenis','helmet')->count();
            $count_kasuttempur      = SnapPasukan:: select('id') ->where('jenis','kasuttempur')->count();
            $count_topiloreng       = SnapPasukan:: select('id') ->where('jenis','topiloreng')->count();
            $count_webbinglengkap   = SnapPasukan:: select('id') ->where('jenis','webbinglengkap')->count();
            $count_jerseypullover   = SnapPasukan:: select('id') ->where('jenis','jerseypullover')->count();
            $count_stokinghijau     = SnapPasukan:: select('id') ->where('jenis','stokinhijau')->count();
            $count_bajutempur       = SnapPasukan:: select('id') ->where('jenis','bajutempur')->count();
            $count_inner            = SnapPasukan:: select('id') ->where('jenis','inner')->count();

            $boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','persendirian' )
            ->selectRaw("SUM(BG) as percentage,jenis as source")
            ->groupBy('jenis')
            ->get()->ToArray();

            $tidakboleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','persendirian' )
                        ->selectRaw("SUM(tbg) as percentage,jenis as source")
                        ->groupBy('jenis')
                        ->get()->ToArray();

            $namauntukjenisbar =  SnapPasukan:: where('SUBKATEGORI_ASET','persendirian' )
                                ->select('jenis')
                                ->groupBy('jenis')
                                ->get();

            $hak =  SnapPasukan::where('SUBKATEGORI_ASET','persendirian' )
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
       
        return view('khidmat.persendirian',compact('caripasukan','bolehgunatiadadata','tiadadata','tidakBolehtiadadata','pasukan_id','unit','count_helmet','count_kasuttempur','count_topiloreng','count_webbinglengkap','count_jerseypullover','count_stokinghijau','count_bajutempur','count_inner','boleh_guna','tidakboleh_guna','namadalamarray','keupayaan','kesiagaan','pasukan','divisyen','formasi','briged','hak'));

    }
    public function peluru($id)
    { 
        $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;
        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','peluru' )
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','peluru' )
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }else{
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','peluru' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','peluru' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }

        if (!empty($boleh_guna ))
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
        return view('khidmat.peluru',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
        
    }
    public function letupan($id)
    { 
        $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;
        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','letupan' )
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','letupan' )
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }else{
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','letupan' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','letupan' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }

        if (!empty($boleh_guna ))
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

        return view('khidmat.letupan',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }
    public function jurutera($id)
    {  $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;
        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','jurutera' )
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','jurutera' )
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }else{
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','jurutera' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','jurutera' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }


        if (!empty($boleh_guna ))
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
        return view('khidmat.jurutera',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
        
    }
    public function preventif($id)
    { 
        $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;
        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','preventif' )
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','preventif' )
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }else{
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','preventif' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','preventif' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }

        if (!empty($boleh_guna ))
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
        return view('khidmat.preventif',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }
    public function rangsum($id)
    {  $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;
        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            
        $peg  = SnapPasukan:: where('SUBKATEGORI_ASET','Rangsum' )
                                        ->selectRaw("SUM(PEG) as percentage,JENIS as source")
                                        ->groupBy('JENIS')
                                        // ->having('percentage', '>', 0)
                                        ->get()->ToArray();


        $hak  =  SnapPasukan:: where('SUBKATEGORI_ASET','Rangsum' )
                            ->selectRaw("SUM(HAK) as percentage,JENIS as source")
                            ->groupBy('JENIS')
                            // ->having('percentage', '>', 0)
                            ->get()->ToArray();
        }else{
            
            $peg  = SnapPasukan:: where('SUBKATEGORI_ASET','Rangsum' )
                                ->where('IDPASUKAN',$id)
                                ->selectRaw("SUM(PEG) as percentage,JENIS as source")
                                ->groupBy('JENIS')
                                ->having('percentage', '>', 0)
                                ->get()->ToArray();

            $hak  =  SnapPasukan:: where('SUBKATEGORI_ASET','Rangsum' )
                                ->where('IDPASUKAN',$id)
                                ->selectRaw("SUM(HAK) as percentage,JENIS as source")
                                ->groupBy('JENIS')
                                ->having('percentage', '>', 0)
                                ->get()->ToArray();
        }

        if (!empty($peg ))
        {
            $pegtiadadata = 0;
        }else{
           
            $pegtiadadata = 'TIADA DATA';
        }

        if (!empty($hak))
        {
            $haktiadadata = 0;
        }else{
           
            $haktiadadata = 'TIADA DATA';
        }
        return view('khidmat.rangsum',compact('caripasukan','pegtiadadata','haktiadadata','pasukan_id','unit','peg','hak','pasukan','divisyen','formasi','briged'));
        
    }

    public function pegangan( $kategeriutama, $idpasukan)
    {  
        $caripasukan = Pasukan::find($idpasukan);
        $pasukan_id = $caripasukan->idpasukan;
        $unit = $caripasukan->nama;
                
        if($idpasukan == "21ece77a-4382-11ed-8dfb-0242ac110002"){
        $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN') 
                            ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.PEG')
                            ->where('KATEGORI_UTAMA',$kategeriutama )
                            ->get();

        }else{
            $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN') 
                                ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.PEG')
                                ->where('snap_pasukan.KATEGORI_UTAMA',$kategeriutama )
                                ->where('IDPASUKAN',$idpasukan)
                                ->get();
        }   

        $jenis =   $kategeriutama;     
        $status = "PEGANGAN";    
            
        return view('khidmat.detail',compact('data','jenis','status','caripasukan'));
    }
    
    public function hak($kategeriutama, $idpasukan)
    {
        $caripasukan = Pasukan::find($idpasukan);
        $pasukan_id = $caripasukan->idpasukan;
        $unit = $caripasukan->nama;
        
        // DD($idpasukan);
        
        if($idpasukan == "21ece77a-4382-11ed-8dfb-0242ac110002"){
        $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN') 
                            ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.HAK',)
                            ->where('KATEGORI_UTAMA',$kategeriutama )
                            ->get();

        }else{
            $data =  SnapPasukan::join('og_unit', 'og_unit.ID', '=', 'snap_pasukan.IDPASUKAN') 
                                ->select('og_unit.NAMA as namapasukan','snap_pasukan.JENIS','snap_pasukan.KATEGORI_UTAMA','snap_pasukan.HAK')
                                ->where('snap_pasukan.KATEGORI_UTAMA',$kategeriutama )
                                ->where('IDPASUKAN',$idpasukan)
                                ->get();
        }   

        $jenis =   $kategeriutama;     
        $status = "HAK";    
            
        return view('khidmat.detail',compact('data','jenis','status','caripasukan'));
    }

 
    public function ict($id)
    { 
        $caripasukan = Pasukan::find($id);
        $pasukan_id = $caripasukan->id;
        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','ict' )
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','ict' )
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }else{
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','ict' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET','ict' )
        ->where('IDPASUKAN',$id)
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }
        if (!empty($boleh_guna ))
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

        return view('khidmat.ict',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }

    public function detailpersendirian($idpasukan, $subkategori)
    { 
        $caripasukan = Pasukan::find($idpasukan);
        $pasukan_id = $caripasukan->idpasukan;
        $unit = $caripasukan->nama;

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        if($idpasukan == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET', $subkategori )
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET', $subkategori)
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }else{
            
        $boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET', $subkategori )
        ->where('IDPASUKAN',$idpasukan)
        ->whereIn('status_siaga',['BG','BP','BDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();

        $tidak_boleh_guna  = ItemPasukan:: where('SUBKATEGORI_ASET', $subkategori )
        ->where('IDPASUKAN',$idpasukan)
        ->whereIn('status_siaga',['TBG','TBDG'])
        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
        ->groupBy('kategori_utama')
        ->get()->ToArray();
        }
        if (!empty($boleh_guna ))
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

        $namapage = $subkategori;

        return view('khidmat.detailpersendirian',compact('caripasukan','bolehgunatiadadata','namapage','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }

    
}
