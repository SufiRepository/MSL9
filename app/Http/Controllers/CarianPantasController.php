<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasukan;
use App\Models\ItemPasukan;

class CarianPantasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasukan = Pasukan::all();

        $kategori = ItemPasukan::select('kategori_aset')->groupby('kategori_aset')->get();
        $sub = ItemPasukan::select('SUBKATEGORI_ASET')->groupby('SUBKATEGORI_ASET')->groupby('SUBKATEGORI_ASET')->get();
        $jen = ItemPasukan::select('jenis')->groupby('jenis')->groupby('jenis')->get();
     
       
        return view('carianpantas.carianpantas',compact('pasukan','kategori','sub','jen'));
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
       
        // $namapaparan="Tentera";
        // dd($request->all());

        $pasukans = Pasukan::all();

        $kat = ItemPasukan::select('kategori_aset')->groupby('kategori_aset')->get();
        $sub = ItemPasukan::select('SUBKATEGORI_ASET')->groupby('SUBKATEGORI_ASET')->groupby('SUBKATEGORI_ASET')->get();
        $jen = ItemPasukan::select('jenis')->groupby('jenis')->groupby('jenis')->get();
        
        $kategori = $request->KATEGORI_ASET;
        $subkategori = $request->SUBKATEGORI_ASET;
        $jenis = $request->JENIS;
        $pasukan =  $request->pasukan_id;

        $namapasukan = Pasukan::find($pasukan);

        // if($pasukan == "21ece77a-4382-11ed-8dfb-0242ac110002"){

        //         if(  $kategori != null){

        //             $data =  ItemPasukan::  join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
        //             ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET','item_pasukan.STATUS_SIAGA')
        //             ->where('KATEGORI_ASET',$kategori)->get();
        //             $namapaparan = $kategori;
        //         }  

        //         if(  $subkategori != null){
                
        //             $data =  ItemPasukan:: join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
        //             ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET','item_pasukan.STATUS_SIAGA')
        //             ->where('SUBKATEGORI_ASET',$subkategori)->get();
        //             $namapaparan = $subkategori;
        //         }

        //         if(  $jenis != null){
        //             $data =  ItemPasukan:: join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
        //             ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET','item_pasukan.STATUS_SIAGA')
        //             -> where('JENIS',$jenis)->get();
        //             $namapaparan = $subkategori;
        //         }
        //         if($kategori != null &&  $subkategori != null && $jenis != null){
        //             $data =  ItemPasukan:: where('KATEGORI_ASET',$kategori)
        //                                 -> where('SUBKATEGORI_ASET',$subkategori)
        //                                 -> where('JENIS',$jenis)
        //                                 -> get();
        //         $namapaparan = $subkategori;
        //         }
        // }else{
            
                // if(  $kategori != null){

                //     $data =  ItemPasukan::  join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                //     ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET','item_pasukan.STATUS_SIAGA')
                //     ->where('idpasukan',$pasukan)
                //     ->where('KATEGORI_ASET',$kategori)->get();
                //     $namapaparan = $kategori;
                // }  
            
                // if(  $subkategori != null){
                
                //     $data =  ItemPasukan:: join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                //     ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET','item_pasukan.STATUS_SIAGA')
                //     ->where('idpasukan',$pasukan)
                //     ->where('SUBKATEGORI_ASET',$subkategori)->get();
                //     $namapaparan = $subkategori;
                // }
            
                // if(  $jenis != null){
                //     $data =  ItemPasukan:: join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                //     ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET','item_pasukan.STATUS_SIAGA')
                //     ->where('idpasukan',$pasukan)
                //     -> where('JENIS',$jenis)->get();
                //     $namapaparan = $subkategori;
                // }

                // if(  $namapasukan != null){
                //     $data =  ItemPasukan:: join('og_unit', 'og_unit.ID', '=', 'item_pasukan.IDPASUKAN') 
                //     ->select('og_unit.NAMA as namapasukan','item_pasukan.PART_NO','item_pasukan.KATEGORI_UTAMA','item_pasukan.JENAMA','item_pasukan.SUBKATEGORI_ASET','item_pasukan.KATEGORI_ASET','item_pasukan.STATUS_SIAGA')
                //     ->where('idpasukan',$pasukan)->get();
                //     // -> where('JENIS',$jenis)
                //     $namapaparan = $subkategori;
                // }

                // if($kategori != null &&  $subkategori != null && $jenis != null){
                //     $data =  ItemPasukan:: where('KATEGORI_ASET',$kategori)
                //                         -> where('SUBKATEGORI_ASET',$subkategori)
                //                         ->where('idpasukan',$pasukan)
                //                         -> where('JENIS',$jenis)
                //                         -> get();
                // $namapaparan = $subkategori;
                // }
                
                $obj =  ItemPasukan:: where('idpasukan','<>','');
                if($pasukan == "21ece77a-4382-11ed-8dfb-0242ac110002"){
                    $namapaparan="Tentera";
 
                }else{

                    if($pasukan != null){
                        $obj-> where('idpasukan',$pasukan);
                        $namapaparan=$pasukan;
                    }  
                }
               
                
                if($kategori != null){
                    
                    $obj -> where('KATEGORI_ASET',$kategori);
                    $namapaparan = $kategori;
                }
                if($subkategori != null){
                    
                    $obj -> where('SUBKATEGORI_ASET',$subkategori);
                    $namapaparan = $subkategori;
                }
                if( $jenis != null){
                    
                    $obj -> where('JENIS',$jenis);
                }

              //  $data =  ItemPasukan:: where('KATEGORI_ASET',$kategori)
               // -> where('SUBKATEGORI_ASET',$subkategori)
               // ->where('idpasukan',$pasukan)
               // -> where('JENIS',$jenis)
               $data =$obj-> get();
                //dd($data);
               // $namapaparan = $subkategori;
                // dd(json_encode($data));
        //}

        return view('carianpantas.detail',compact('data','namapaparan','namapasukan','pasukans','kat','sub','jen'));
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
}
