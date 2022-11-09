<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SnapPasukan;
use App\Models\Pasukan;
use App\Models\OrgMatriks;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('dashboard');
    }

    public function dashbord()
    {
        return view('home');
    }

    public function carian($id)
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

            $formasi = Pasukan::where('flagship','formasi')->get();
            $divisyen = Pasukan::where('flagship','divisyen')->get();
            $briged= Pasukan::where('flagship','briged')->get();
            $pasukan = Pasukan::where('flagship','pasukan')->get();

            $count_Utama = SnapPasukan::select('id')
                                            ->where('kategori_aset','Aset Utama' )
                                            ->sum('PEG');

            $count_Dukungan = SnapPasukan::select('jenis')
                                            ->where('kategori_aset','Aset Dukungan' )
                                            ->sum('PEG');

            $count_Komunikasi = SnapPasukan::select('jenis')
                                                ->where('kategori_aset','Komunikasi' )
                                                ->sum('PEG');

            $count_Khidmat = SnapPasukan::select('jenis')
                                            ->where('kategori_aset','Khidmat' )
                                            ->sum('PEG');

            $hak =  SnapPasukan:: join("ut_kategori_aset","ut_kategori_aset.nama","=","snap_pasukan.KATEGORI_ASET")
                                    -> selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,kategori_aset")
                                    ->orderBy('orderno', 'asc')
                                    ->groupBy('kategori_aset')
                                    ->get();

            $namauntukjenisbar =  SnapPasukan::join("ut_kategori_aset","ut_kategori_aset.nama","=","snap_pasukan.KATEGORI_ASET")
                                                ->select('kategori_aset')
                                                ->groupBy('kategori_aset')
                                                ->orderBy('orderno', 'asc')
                                                ->get();
        }
        else{

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
            //   dd($listUnitId);

            $count_Utama = SnapPasukan::select('id')
                                    ->where('kategori_aset','Aset Utama' )
                                    ->whereIn('IDPASUKAN', $listUnitId)
                                    ->sum('PEG');

            $count_Dukungan = SnapPasukan::select('jenis')
                            ->where('kategori_aset','Aset Dukungan' )
                            ->whereIn('IDPASUKAN', $listUnitId)
                            ->sum('PEG');

            $count_Komunikasi = SnapPasukan::select('jenis')
                                ->where('kategori_aset','Komunikasi' )
                                ->whereIn('IDPASUKAN', $listUnitId)
                                ->sum('PEG');

            $count_Khidmat = SnapPasukan::select('jenis')
                            ->where('kategori_aset','Khidmat' )
                            ->whereIn('IDPASUKAN', $listUnitId)
                            ->sum('PEG');

            $hak =  SnapPasukan:: join("ut_kategori_aset","ut_kategori_aset.nama","=","snap_pasukan.KATEGORI_ASET")
                    -> selectRaw("SUM(hak) as hak,SUM(peg) as pegangan,SUM(BG) as BG,SUM(TBG) as TBG,kategori_aset")
                    ->whereIn('IDPASUKAN', $listUnitId)
                    ->orderBy('orderno', 'asc')
                    ->groupBy('kategori_aset')
                    ->get();

            $namauntukjenisbar =  SnapPasukan::join("ut_kategori_aset","ut_kategori_aset.nama","=","snap_pasukan.KATEGORI_ASET")
                                ->select('kategori_aset')
                                ->whereIn('IDPASUKAN', $listUnitId)
                                ->groupBy('kategori_aset')
                                ->orderBy('orderno', 'asc')
                                ->get();
            }

        $hakarray = [];
        $peganganarray  = [];
        $namadalamarray = [];
        $jum = 0;

        foreach($namauntukjenisbar as $namadlmarray)
        {
            $namadalamarray[] = $namadlmarray->kategori_aset;
        }

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

        return view('dashboard',compact('caripasukan','count_Utama','count_Dukungan','count_Komunikasi','count_Khidmat','keupayaan','kesiagaan','namadalamarray','hak','pasukan','divisyen','formasi','briged'));
    }
}
