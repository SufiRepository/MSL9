<?php

namespace App\Http\Controllers;

use App\Models\Utama;
use Illuminate\Http\Request;

use App\Models\ItemPasukan;
use App\Models\SnapPasukan;
use App\Models\Pasukan;
use App\Models\OrgMatriks;

class UtamaController extends Controller
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
     * @param  \App\Models\Utama  $utama
     * @return \Illuminate\Http\Response
     */
    public function show(Utama $utama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Utama  $utama
     * @return \Illuminate\Http\Response
     */
    public function edit(Utama $utama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Utama  $utama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Utama $utama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Utama  $utama
     * @return \Illuminate\Http\Response
     */
    public function destroy(Utama $utama)
    {
        //
    }

    public function carianutama($id)
    {
        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        $caripasukan = Pasukan::find($id);
        $unit = $caripasukan->nama;
        $pasukan_id = $caripasukan->id;
        $flagship = $caripasukan->flagship;

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){

        $count_kja = SnapPasukan::select('id')   
                        ->where('SUBKATEGORI_ASET','kja' )
                        ->sum('PEG');

        $count_senjata = SnapPasukan::select('SUBKATEGORI_ASET')   
                        ->where('SUBKATEGORI_ASET','Senjata' )
                        ->sum('PEG');

        $count_artileri = SnapPasukan::select('SUBKATEGORI_ASET')   
                        ->where('SUBKATEGORI_ASET','Aset Artileri' )
                        ->sum('PEG');

        $count_khusus = SnapPasukan::select('SUBKATEGORI_ASET')   
                        ->where('SUBKATEGORI_ASET','khusus' )
                        ->sum('PEG');

        $boleh_guna  = SnapPasukan:: where('kategori_aset','Aset Utama' )
                                    ->selectRaw("SUM(BG) as percentage,SUBKATEGORI_ASET as source")
                                    ->groupBy('SUBKATEGORI_ASET')
                                    ->get()->ToArray();

        $tidakboleh_guna  = SnapPasukan:: where('kategori_aset','Aset Utama' )
                                    ->selectRaw("SUM(tbg) as percentage,SUBKATEGORI_ASET as source")
                                    ->groupBy('SUBKATEGORI_ASET')
                                    ->get()->ToArray();

        $namauntukjenisbar =  SnapPasukan:: join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                                            ->where('kategori_aset','Aset Utama' )
                                            ->select('SUBKATEGORI_ASET')
                                            ->groupBy('ut_subkategori_aset.nama')
                                            ->orderBy('orderno', 'asc')
                                            ->get();

        //keupayaan
        $hak =  SnapPasukan::join("ut_subkategori_aset","ut_subkategori_aset.nama","=","snap_pasukan.SUBKATEGORI_ASET")
                            ->where('kategori_aset','Aset Utama' )
                            ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,SUBKATEGORI_ASET")
                            ->groupBy('SUBKATEGORI_ASET')
                            ->orderBy('orderno', 'asc')
                            ->get();
                         
        }else{

            switch ($flagship) {
                case "FORMASI":
                    //nak dapatkan senarai DIVISYEN bawah dia
                    $getAllFORMASI = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                    ->where('parentId',$id)
                    ->get();
                    $listFORMASI = [];

                    foreach($getAllFORMASI as $gAMS)
                    {
                    $listFORMASI[] = $gAMS->unit_id;
                    }

                    //nak dapatkan senarai briged bawah dia
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->whereIn('parentId',$listFORMASI)
                                                        ->get();
                    $listdivisyen = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listdivisyen[] = $gAMS->unit_id;
                    }

                     //nak dapatkan senarai pasukan bawah dia
                    $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                ->wherein('parentId',$listdivisyen)
                                                ->get();

                    $listUnitId = [];

                    foreach($getlistbriged as $gAMS)
                        {
                         $listUnitId[] = $gAMS->unit_id;
                        }
                break;
                case "DIVISYEN":
                    //nak dapatkan senarai briged bawah dia
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->where('parentId',$id)
                                                        ->get();
                    $listdivisyen = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listdivisyen[] = $gAMS->unit_id;
                    }

                     //nak dapatkan senarai pasukan bawah dia
                    $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                ->wherein('parentId',$listdivisyen)
                                                ->get();

                    $listUnitId = [];

                    foreach($getlistbriged as $gAMS)
                        {
                         $listUnitId[] = $gAMS->unit_id;
                        }
                  break;
                case "BRIGED":
        
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->where('parentId',$id)
                                                        ->get();
                    $listUnitId = [];
            
                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                                   $listUnitId[] = $gAMS->unit_id;
                    }
                  break;
                case "PASUKAN":
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                    ->where('unit_id',$id)
                    ->get();
                    $listUnitId = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listUnitId[] = $gAMS->unit_id;
                    }
                break;
              }

            $count_kja = SnapPasukan::select('id')   
                        ->where('jenis','kja' )
                        ->whereIn('IDPASUKAN', $listUnitId)
                        ->sum('PEG');

            $count_senjata = SnapPasukan::select('SUBKATEGORI_ASET')   
                        ->where('SUBKATEGORI_ASET','Senjata' )
                        ->whereIn('IDPASUKAN', $listUnitId)
                        ->sum('PEG');

            $count_artileri = SnapPasukan::select('SUBKATEGORI_ASET')   
                        ->where('SUBKATEGORI_ASET','Aset Artileri' )
                        ->whereIn('IDPASUKAN', $listUnitId)
                        ->sum('PEG');

            $count_khusus = SnapPasukan::select('SUBKATEGORI_ASET')   
                        ->where('SUBKATEGORI_ASET','khusus' )
                        ->whereIn('IDPASUKAN', $listUnitId)
                        ->sum('PEG');

            $boleh_guna  = SnapPasukan:: where('kategori_aset','Aset Utama' )
                                    ->selectRaw("SUM(BG) as percentage,SUBKATEGORI_ASET as source")
                                    ->groupBy('SUBKATEGORI_ASET')
                                    ->whereIn('IDPASUKAN', $listUnitId)
                                    ->get()->ToArray();

            $tidakboleh_guna  = SnapPasukan:: where('kategori_aset','Aset Utama' )
                                    ->selectRaw("SUM(tbg) as percentage,SUBKATEGORI_ASET as source")
                                    ->groupBy('SUBKATEGORI_ASET')
                                    ->whereIn('IDPASUKAN', $listUnitId)
                                    ->get()->ToArray();

            $namauntukjenisbar =  SnapPasukan:: where('kategori_aset','Aset Utama' )
                                                ->select('SUBKATEGORI_ASET')
                                                ->groupBy('SUBKATEGORI_ASET')
                                                ->whereIn('IDPASUKAN', $listUnitId)
                                                ->get();

                                            //keupayaan
            $hak =  SnapPasukan::where('kategori_aset','Aset Utama' )
                                ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,SUBKATEGORI_ASET")
                                ->groupBy('SUBKATEGORI_ASET')
                                ->whereIn('IDPASUKAN', $listUnitId)
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
                $jumhak = $datahak->hak;

            } else {
                $jumhak = "1";
            }

            $hakarray[] = $jumhak;
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
        return view('utama.utama',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','count_kja','count_senjata','count_artileri','count_khusus','boleh_guna','tidakboleh_guna','namadalamarray','keupayaan','kesiagaan','pasukan','divisyen','formasi','briged','hak'));

    } 

    public function cariankja($id)
    {
        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        $caripasukan = Pasukan::find($id);
        $unit = $caripasukan->nama;
        $pasukan_id = $caripasukan->id;
        $flagship = $caripasukan->flagship;

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){

            $boleh_guna  = ItemPasukan:: where('jenis','KJA' )
                                        ->whereIn('status_siaga',['BG','BP','BDG'])
                                        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                        ->groupBy('kategori_utama')
                                        ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan:: where('jenis','KJA' )
                                                ->whereIn('status_siaga',['TBG','TBDG'])
                                                ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                                ->groupBy('kategori_utama')
                                                ->get()->ToArray(); 
        }else{
            switch ($flagship) {
                case "FORMASI":
                    //nak dapatkan senarai DIVISYEN bawah dia
                    $getAllFORMASI = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                    ->where('parentId',$id)
                    ->get();
                    $listFORMASI = [];

                    foreach($getAllFORMASI as $gAMS)
                    {
                    $listFORMASI[] = $gAMS->unit_id;
                    }

                    //nak dapatkan senarai briged bawah dia
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->whereIn('parentId',$listFORMASI)
                                                        ->get();
                    $listdivisyen = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listdivisyen[] = $gAMS->unit_id;
                    }

                     //nak dapatkan senarai pasukan bawah dia
                    $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                ->wherein('parentId',$listdivisyen)
                                                ->get();

                    $listUnitId = [];

                    foreach($getlistbriged as $gAMS)
                        {
                         $listUnitId[] = $gAMS->unit_id;
                        }
                break;
                case "DIVISYEN":
                    //nak dapatkan senarai briged bawah dia
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->where('parentId',$id)
                                                        ->get();
                    $listdivisyen = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listdivisyen[] = $gAMS->unit_id;
                    }

                     //nak dapatkan senarai pasukan bawah dia
                    $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                ->wherein('parentId',$listdivisyen)
                                                ->get();

                    $listUnitId = [];

                    foreach($getlistbriged as $gAMS)
                        {
                         $listUnitId[] = $gAMS->unit_id;
                        }
                  break;
                case "BRIGED":
        
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->where('parentId',$id)
                                                        ->get();
                    $listUnitId = [];
            
                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                                   $listUnitId[] = $gAMS->unit_id;
                    }
                  break;
                case "PASUKAN":
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                    ->where('unit_id',$id)
                    ->get();
                    $listUnitId = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listUnitId[] = $gAMS->unit_id;
                    }
                break;
              }
            $boleh_guna  = ItemPasukan:: where('jenis','KJA' )
                                        ->whereIn('IDPASUKAN', $listUnitId)
                                        ->whereIn('status_siaga',['BG','BP','BDG'])
                                        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                        ->groupBy('kategori_utama')
                                        ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan:: where('jenis','KJA' )
                                            ->whereIn('IDPASUKAN', $listUnitId)
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

        return view('utama.kja',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }

    public function senjata($id)
    {

        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        $caripasukan = Pasukan::find($id);
        $unit = $caripasukan->nama;
        $pasukan_id = $caripasukan->id;
        $flagship = $caripasukan->flagship;

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){

            $boleh_guna  = ItemPasukan:: where('jenis','senjata' )
                                        ->whereIn('status_siaga',['BG','BP','BDG'])
                                        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                        ->groupBy('kategori_utama')
                                        ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan::where('jenis','senjata' )
                                            ->whereIn('status_siaga',['TBG','TBDG'])
                                            ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                            ->groupBy('kategori_utama')
                                            ->get()->ToArray();

        }else{ 
             switch ($flagship) {
                case "FORMASI":
                    //nak dapatkan senarai DIVISYEN bawah dia
                    $getAllFORMASI = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                    ->where('parentId',$id)
                    ->get();
                    $listFORMASI = [];

                    foreach($getAllFORMASI as $gAMS)
                    {
                    $listFORMASI[] = $gAMS->unit_id;
                    }

                    //nak dapatkan senarai briged bawah dia
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->whereIn('parentId',$listFORMASI)
                                                        ->get();
                    $listdivisyen = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listdivisyen[] = $gAMS->unit_id;
                    }

                     //nak dapatkan senarai pasukan bawah dia
                    $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                ->wherein('parentId',$listdivisyen)
                                                ->get();

                    $listUnitId = [];

                    foreach($getlistbriged as $gAMS)
                        {
                         $listUnitId[] = $gAMS->unit_id;
                        }
                break;
                case "DIVISYEN":
                    //nak dapatkan senarai briged bawah dia
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->where('parentId',$id)
                                                        ->get();
                    $listdivisyen = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listdivisyen[] = $gAMS->unit_id;
                    }

                     //nak dapatkan senarai pasukan bawah dia
                    $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                ->wherein('parentId',$listdivisyen)
                                                ->get();

                    $listUnitId = [];

                    foreach($getlistbriged as $gAMS)
                        {
                         $listUnitId[] = $gAMS->unit_id;
                        }
                  break;
                case "BRIGED":
        
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->where('parentId',$id)
                                                        ->get();
                    $listUnitId = [];
            
                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                                   $listUnitId[] = $gAMS->unit_id;
                    }
                  break;
                case "PASUKAN":
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                    ->where('unit_id',$id)
                    ->get();
                    $listUnitId = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listUnitId[] = $gAMS->unit_id;
                    }
                break;
              }
            $boleh_guna  = ItemPasukan:: where('jenis','senjata' )
                                        ->whereIn('IDPASUKAN', $listUnitId)
                                        ->whereIn('status_siaga',['BG','BP','BDG'])
                                        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                        ->groupBy('kategori_utama')
                                        ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan:: where('jenis','senjata' )
                                            ->whereIn('IDPASUKAN', $listUnitId)
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

        return view('utama.senjata',compact('caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }
    public function artileri($id)
    {
        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        $caripasukan = Pasukan::find($id);
        $unit = $caripasukan->nama;
        $pasukan_id = $caripasukan->id;
        $flagship = $caripasukan->flagship;

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){

            $count_medan = SnapPasukan::select('id')   
                            ->where('jenis','MEDAN' )
                            ->sum('PEG');
    
            $count_udara = SnapPasukan::select('id')   
                            ->where('jenis','PERTAHANAN UDARA' )
                            ->sum('PEG');
    
    
            $boleh_guna  = SnapPasukan::    where('SUBKATEGORI_ASET','Aset Artileri' )
                                    ->      selectRaw("SUM(BG) as percentage,jenis as source")
                                    ->      groupBy('jenis')
                                    ->      get()->ToArray();
    
            $tidakboleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Aset Artileri' )
                                            ->  selectRaw("SUM(tbg) as percentage,jenis as source")
                                            ->  groupBy('jenis')
                                            ->  get()->ToArray();
            
            $namauntukjenisbar =  SnapPasukan:: join("ut_subsubkategori_aset","ut_subsubkategori_aset.nama","=","snap_pasukan.jenis")
                                                ->where('SUBKATEGORI_ASET','Aset Artileri' )
                                                ->select('jenis')
                                                ->groupBy('jenis')
                                                ->orderBy('orderno', 'asc')
                                                ->get();
    
            //keupayaan
            $hak =  SnapPasukan:: join("ut_subsubkategori_aset","ut_subsubkategori_aset.nama","=","snap_pasukan.jenis")
                                ->where('SUBKATEGORI_ASET','Aset Artileri' )
                                ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,jenis")
                                ->groupBy('jenis')
                                ->orderBy('orderno', 'asc')
                                ->get();
    
                             
            }else{

                switch ($flagship) {
                    case "FORMASI":
                        //nak dapatkan senarai DIVISYEN bawah dia
                        $getAllFORMASI = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                        ->where('parentId',$id)
                        ->get();
                        $listFORMASI = [];
    
                        foreach($getAllFORMASI as $gAMS)
                        {
                        $listFORMASI[] = $gAMS->unit_id;
                        }
    
                        //nak dapatkan senarai briged bawah dia
                        $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                            ->whereIn('parentId',$listFORMASI)
                                                            ->get();
                        $listdivisyen = [];
    
                        foreach($getAllMatrikSaluran as $gAMS)
                        {
                        $listdivisyen[] = $gAMS->unit_id;
                        }
    
                         //nak dapatkan senarai pasukan bawah dia
                        $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                    ->wherein('parentId',$listdivisyen)
                                                    ->get();
    
                        $listUnitId = [];
    
                        foreach($getlistbriged as $gAMS)
                            {
                             $listUnitId[] = $gAMS->unit_id;
                            }
                    break;
                    case "DIVISYEN":
                        //nak dapatkan senarai briged bawah dia
                        $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                            ->where('parentId',$id)
                                                            ->get();
                        $listdivisyen = [];
    
                        foreach($getAllMatrikSaluran as $gAMS)
                        {
                        $listdivisyen[] = $gAMS->unit_id;
                        }
    
                         //nak dapatkan senarai pasukan bawah dia
                        $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                    ->wherein('parentId',$listdivisyen)
                                                    ->get();
    
                        $listUnitId = [];
    
                        foreach($getlistbriged as $gAMS)
                            {
                             $listUnitId[] = $gAMS->unit_id;
                            }
                      break;
                    case "BRIGED":
            
                        $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                            ->where('parentId',$id)
                                                            ->get();
                        $listUnitId = [];
                
                        foreach($getAllMatrikSaluran as $gAMS)
                        {
                                       $listUnitId[] = $gAMS->unit_id;
                        }
                      break;
                    case "PASUKAN":
                        $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                        ->where('unit_id',$id)
                        ->get();
                        $listUnitId = [];
    
                        foreach($getAllMatrikSaluran as $gAMS)
                        {
                        $listUnitId[] = $gAMS->unit_id;
                        }
                    break;
                  }

    
                $count_medan = SnapPasukan::select('id')   
                            ->where('jenis','MEDAN' )
                            ->whereIn('IDPASUKAN',$listUnitId)
                            ->sum('PEG');
    
                $count_udara = SnapPasukan::select('id')   
                            ->where('jenis','PERTAHANAN UDARA' )
                            ->whereIn('IDPASUKAN',$listUnitId)
                            ->sum('PEG');
    
                $boleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Aset Artileri' )
                                        ->selectRaw("SUM(BG) as percentage,SUBKATEGORI_ASET as source")
                                        ->groupBy('SUBKATEGORI_ASET')
                                        ->whereIn('IDPASUKAN',$listUnitId)
                                        ->get()->ToArray();
    
                $tidakboleh_guna  = SnapPasukan:: where('SUBKATEGORI_ASET','Aset Artileri' )
                                        ->selectRaw("SUM(tbg) as percentage,SUBKATEGORI_ASET as source")
                                        ->groupBy('SUBKATEGORI_ASET')
                                        ->whereIn('IDPASUKAN',$listUnitId)
                                        ->get()->ToArray();
    
                $namauntukjenisbar =  SnapPasukan:: where('SUBKATEGORI_ASET','Aset Artileri' )
                                                    ->select('SUBKATEGORI_ASET')
                                                    ->groupBy('SUBKATEGORI_ASET')
                                                    ->whereIn('IDPASUKAN',$listUnitId)
                                                    ->get();
    
                                                //keupayaan
                $hak =  SnapPasukan::where('SUBKATEGORI_ASET','Aset Artileri' )
                                    ->selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,SUBKATEGORI_ASET")
                                    ->groupBy('SUBKATEGORI_ASET')
                                    ->whereIn('IDPASUKAN',$listUnitId)
                                    ->get();
            }
            
            $namadalamarray = [];
    
            foreach($namauntukjenisbar as $namadlmarray) 
            {
                $namadalamarray[] = $namadlmarray->jenis;
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
            $navlink = ['utama','artileri',$id];
            return view('utama.artileri',compact('navlink','caripasukan','bolehgunatiadadata','tiadadata','tidakBolehtiadadata','pasukan_id','unit','count_medan','count_udara','boleh_guna','tidakboleh_guna','namadalamarray','keupayaan','kesiagaan','pasukan','divisyen','formasi','briged','hak'));
        
    }
    
    public function medan($id)
    {
        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        $caripasukan = Pasukan::find($id);
        $unit = $caripasukan->nama;
        $pasukan_id = $caripasukan->id;
        $flagship = $caripasukan->flagship;

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $boleh_guna  = ItemPasukan:: where('jenis','medan' )
                                        ->whereIn('status_siaga',['BG','BP','BDG'])
                                        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                        ->groupBy('kategori_utama')
                                        ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan:: where('jenis','medan' )
                                            ->whereIn('status_siaga',['TBG','TBDG'])
                                            ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                            ->groupBy('kategori_utama')
                                            ->get()->ToArray();
        }else{
            switch ($flagship) {
                case "FORMASI":
                    //nak dapatkan senarai DIVISYEN bawah dia
                    $getAllFORMASI = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                    ->where('parentId',$id)
                    ->get();
                    $listFORMASI = [];

                    foreach($getAllFORMASI as $gAMS)
                    {
                    $listFORMASI[] = $gAMS->unit_id;
                    }

                    //nak dapatkan senarai briged bawah dia
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->whereIn('parentId',$listFORMASI)
                                                        ->get();
                    $listdivisyen = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listdivisyen[] = $gAMS->unit_id;
                    }

                     //nak dapatkan senarai pasukan bawah dia
                    $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                ->wherein('parentId',$listdivisyen)
                                                ->get();

                    $listUnitId = [];

                    foreach($getlistbriged as $gAMS)
                        {
                         $listUnitId[] = $gAMS->unit_id;
                        }
                break;
                case "DIVISYEN":
                    //nak dapatkan senarai briged bawah dia
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->where('parentId',$id)
                                                        ->get();
                    $listdivisyen = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listdivisyen[] = $gAMS->unit_id;
                    }

                     //nak dapatkan senarai pasukan bawah dia
                    $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                ->wherein('parentId',$listdivisyen)
                                                ->get();

                    $listUnitId = [];

                    foreach($getlistbriged as $gAMS)
                        {
                         $listUnitId[] = $gAMS->unit_id;
                        }
                  break;
                case "BRIGED":
        
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->where('parentId',$id)
                                                        ->get();
                    $listUnitId = [];
            
                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                                   $listUnitId[] = $gAMS->unit_id;
                    }
                  break;
                case "PASUKAN":
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                    ->where('unit_id',$id)
                    ->get();
                    $listUnitId = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listUnitId[] = $gAMS->unit_id;
                    }
                break;
              }
            $boleh_guna  = ItemPasukan:: where('jenis','medan' )
                                        ->wherein('IDPASUKAN',$listUnitId)
                                        ->whereIn('status_siaga',['BG','BP','BDG'])
                                        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                        ->groupBy('kategori_utama')
                                        ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan:: where('jenis','medan' )
                                            ->wherein('IDPASUKAN',$listUnitId)
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
        $navlink = ['utama','artileri','medan',$id];

        return view('utama.altiMedan',compact('navlink','caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }

    public function pertahananudara($id)
    {
        $formasi = Pasukan::where('flagship','formasi')->get();
        $divisyen = Pasukan::where('flagship','divisyen')->get();
        $briged= Pasukan::where('flagship','briged')->get();
        $pasukan = Pasukan::where('flagship','pasukan')->get();

        $caripasukan = Pasukan::find($id);
        $unit = $caripasukan->nama;
        $pasukan_id = $caripasukan->id;
        $flagship = $caripasukan->flagship;

        if($id == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $boleh_guna  = ItemPasukan:: where('jenis','PERTAHANAN UDARA' )
                                        ->whereIn('status_siaga',['BG','BP','BDG'])
                                        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                        ->groupBy('kategori_utama')
                                        ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan:: where('jenis','PERTAHANAN UDARA' )
                                            ->whereIn('status_siaga',['TBG','TBDG'])
                                            ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                            ->groupBy('kategori_utama')
                                            ->get()->ToArray();
        }else{
            switch ($flagship) {
                case "FORMASI":
                    //nak dapatkan senarai DIVISYEN bawah dia
                    $getAllFORMASI = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                    ->where('parentId',$id)
                    ->get();
                    $listFORMASI = [];

                    foreach($getAllFORMASI as $gAMS)
                    {
                    $listFORMASI[] = $gAMS->unit_id;
                    }

                    //nak dapatkan senarai briged bawah dia
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->whereIn('parentId',$listFORMASI)
                                                        ->get();
                    $listdivisyen = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listdivisyen[] = $gAMS->unit_id;
                    }

                     //nak dapatkan senarai pasukan bawah dia
                    $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                ->wherein('parentId',$listdivisyen)
                                                ->get();

                    $listUnitId = [];

                    foreach($getlistbriged as $gAMS)
                        {
                         $listUnitId[] = $gAMS->unit_id;
                        }
                break;
                case "DIVISYEN":
                    //nak dapatkan senarai briged bawah dia
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->where('parentId',$id)
                                                        ->get();
                    $listdivisyen = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listdivisyen[] = $gAMS->unit_id;
                    }

                     //nak dapatkan senarai pasukan bawah dia
                    $getlistbriged = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                ->wherein('parentId',$listdivisyen)
                                                ->get();

                    $listUnitId = [];

                    foreach($getlistbriged as $gAMS)
                        {
                         $listUnitId[] = $gAMS->unit_id;
                        }
                  break;
                case "BRIGED":
        
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                                                        ->where('parentId',$id)
                                                        ->get();
                    $listUnitId = [];
            
                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                                   $listUnitId[] = $gAMS->unit_id;
                    }
                  break;
                case "PASUKAN":
                    $getAllMatrikSaluran = OrgMatriks::where('saluran_id','97b325d6-58c8-4704-a396-ce63f9f9b904')
                    ->where('unit_id',$id)
                    ->get();
                    $listUnitId = [];

                    foreach($getAllMatrikSaluran as $gAMS)
                    {
                    $listUnitId[] = $gAMS->unit_id;
                    }
                break;
              }

            $boleh_guna  = ItemPasukan:: where('jenis','PERTAHANAN UDARA' )
                                        ->whereIn('IDPASUKAN',$listUnitId)
                                        ->whereIn('status_siaga',['BG','BP','BDG'])
                                        ->selectRaw('count(status_siaga) as percentage,kategori_utama as source ')
                                        ->groupBy('kategori_utama')
                                        ->get()->ToArray();

            $tidak_boleh_guna  = ItemPasukan:: where('jenis','PERTAHANAN UDARA' )
                                            ->whereIn('IDPASUKAN',$listUnitId)
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
        $navlink = ['utama','artileri','pertahananudara',$id];

     
        return view('utama.altiPertahanan',compact('navlink','caripasukan','bolehgunatiadadata','tidakBolehtiadadata','pasukan_id','unit','boleh_guna','tidak_boleh_guna','pasukan','divisyen','formasi','briged'));
    }

    public function bolehguna($parameter1,$parameter2,$parameter3){
        
        if($parameter2 == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $data =  ItemPasukan::    join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                        ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET')
                        ->where('item_pasukan.SUBKATEGORI_ASET',$parameter1)    
                        ->whereIn('item_pasukan.status_siaga', ['BG', 'BP','BDG'])
                        ->orderBy('item_pasukan.id','DESC')
                        ->get();
        }else{
            $data =  ItemPasukan::    join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                                ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET')
                                ->where('item_pasukan.IDPASUKAN',$parameter2) 
                                ->where('item_pasukan.SUBKATEGORI_ASET',$parameter1)    
                                ->whereIn('item_pasukan.status_siaga', ['BG', 'BP','BDG'])
                                ->orderBy('item_pasukan.id','DESC')
                                ->get();
        }

        $jenis =   $parameter1;     
        $status = "BOLEH GUNA";    
        $previous = $parameter3;               
        return view('utama.detail',compact('data','jenis','status','previous'));
    }

    public function tidakbolehguna($parameter1,$parameter2,$parameter3){
        
        if($parameter2 == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $data =  ItemPasukan:: join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                                ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET')
                                ->where('item_pasukan.SUBKATEGORI_ASET',$parameter1)    
                                ->whereIn('item_pasukan.status_siaga', ['tbg','tbdg'])
                                ->orderBy('item_pasukan.id','DESC')
                                ->get();

        }else{
            $data =  ItemPasukan:: join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                                    ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET')
                                    ->where('item_pasukan.IDPASUKAN',$parameter2) 
                                    ->where('item_pasukan.SUBKATEGORI_ASET',$parameter1)    
                                    ->whereIn('item_pasukan.status_siaga', ['tbg','tbdg'])
                                    ->orderBy('item_pasukan.id','DESC')
                                    ->get();
        }
    
        $jenis =   $parameter1;     
        $status = " TIDAK BOLEH GUNA";    
        $previous = $parameter3; 
        return view('utama.detail',compact('data','jenis','status','previous'));
    }


    public function bolehgunasub($parameter1,$parameter2,$parameter3){

        if($parameter2 == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $data =  ItemPasukan::join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                                ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET')
                                ->where('item_pasukan.kategori_utama',$parameter1)    
                                ->whereIn('item_pasukan.status_siaga', ['BDG','BG','BP'])
                                ->orderBy('item_pasukan.id','DESC')
                                ->get();
        }else{
            $data =  ItemPasukan::join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                                ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET')
                                ->where('item_pasukan.IDPASUKAN',$parameter2) 
                                ->where('item_pasukan.kategori_utama',$parameter1)    
                                ->whereIn('item_pasukan.status_siaga', ['BDG','BG','BP'])
                                ->orderBy('item_pasukan.id','DESC')
                                ->get();
        }

        $jenis =   $parameter1;     
        $status = "BOLEH GUNA";    
        $previous = $parameter3; 

        return view('utama.detail',compact('data','jenis','status','previous'));
    }

    public function tidakbolehgunasub($parameter1,$parameter2,$parameter3){

       
        if($parameter2 == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $data =  ItemPasukan::join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                                ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET')
                                ->where('item_pasukan.kategori_utama',$parameter1)    
                                ->whereIn('item_pasukan.status_siaga', ['tbg','tbdg'])
                                ->orderBy('item_pasukan.id','DESC')
                                ->get();

        }else{

            $data =  ItemPasukan::join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                                ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET')
                                ->where('item_pasukan.IDPASUKAN',$parameter2) 
                                ->where('item_pasukan.kategori_utama',$parameter1)    
                                ->whereIn('item_pasukan.status_siaga', ['tbg','tbdg'])
                                ->orderBy('item_pasukan.id','DESC')
                                ->get();
        }

        $jenis =   $parameter1;     
        $status = "TIDAK BOLEH GUNA";    
        $previous = $parameter3; 

        return view('utama.detail',compact('data','jenis','status','previous'));
    }

    public function bolehgunajenis($parameter1,$parameter2,$parameter3){

        if($parameter2 == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $data =  ItemPasukan::  join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
            ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET')
            ->where('item_pasukan.jenis',$parameter1)    
            ->whereIn('item_pasukan.status_siaga', ['BDG','BG','BP'])
            ->orderBy('item_pasukan.id','DESC')
            ->get();

        }else{

            $data =  ItemPasukan::  join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
            ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET')
            ->where('item_pasukan.IDPASUKAN',$parameter2) 
            ->where('item_pasukan.jenis',$parameter1)    
            ->whereIn('item_pasukan.status_siaga', ['BDG','BG','BP'])
            ->orderBy('item_pasukan.id','DESC')
            ->get();

        }

        $jenis =   $parameter1;     
        $status = "BOLEH GUNA";    
        $previous = $parameter3; 
        
        return view('utama.detail',compact('data','jenis','status','previous'));
    }

    public function tidakbolehgunajenis($parameter1,$parameter2,$parameter3){
        
        if($parameter2 == "21ece77a-4382-11ed-8dfb-0242ac110002"){
            $data =  ItemPasukan::  join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
            ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET')
            ->where('item_pasukan.jenis',$parameter1)    
            ->whereIn('item_pasukan.status_siaga', ['tbg','tbdg'])
            ->orderBy('item_pasukan.id','DESC')
            ->get();

        }else{

            $data =  ItemPasukan::  join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
            ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET')
            ->where('item_pasukan.IDPASUKAN',$parameter2) 
            ->where('item_pasukan.jenis',$parameter1)    
            ->whereIn('item_pasukan.status_siaga', ['tbg','tbdg'])
            ->orderBy('item_pasukan.id','DESC')
            ->get();

        }

        $jenis =   $parameter1;     
        $status = "TIDAK BOLEH GUNA";    
        $previous = $parameter3; 
        return view('utama.detail',compact('data','jenis','status','previous'));
    }

    
}
