<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/dashboard',  [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::post('/newlogin',  [LoginController::class, 'authenticate'])->name('newlogin');
Route::post('/newregister',  [NewRegisterController::class, 'store'])->name('newregister');
Route::get('/registersuccess',  [NewRegisterController::class, 'registersuccess'])->name('registersuccess');
Route::get('/contactadmin',  [NewRegisterController::class, 'contactadmin'])->name('contactadmin');
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

Route::group(['middleware' => ['auth']], function() {
    //larevel route
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('reports', Reportscontroller::class);
    Route::resource('pasukan', Pasukancontroller::class);
    Route::resource('orgchart', OrgChartController::class);
    Route::resource('pangkat', PangkatController::class);
    Route::resource('jawatan', JawatanController::class);
    Route::resource('status', StatusController::class);
    Route::resource('saluran', SaluranController::class);
    Route::resource('orgmatriks', OrgMatriksController::class);
    Route::resource('SpDukungan', SpDukunganAirController::class);
    Route::resource('jutra', SpJutraController::class);
    Route::resource('splogpeluru', SpLogPeluruController::class);
    Route::resource('sputama', SpUtamaController::class);
    Route::resource('carianpantas', CarianPantasController::class);

    Route::get('/dashboard/view/{id}',  [HomeController::class, 'carian'] )->name('carian');


    //query get user
    Route::get('/users/filter/{id}',  [UsersController::class, 'byFilter'] )->name('byFilter');

      // custome route untuk treelist
    Route::get('/orgchart/view/{id}',  [OrgMatriksController::class, 'orgchartview'] )->name('orgchartview');
    Route::get('updateorgmatrix/{parentId}/{matrik_id}',   [OrgMatriksController::class, 'updateorgmatrix'])->name('updateorgmatrix');
    Route::get('/orgchart/{idpasukan}/{idsaluran}',  [OrgMatriksController::class, 'orgcharteditpasukan'] )->name('orgcharteditpasukan');
    Route::put('/orgchart/{idpasukan}/{idsaluran}', [OrgMatriksController::class, 'orgchartupdatepasukan'])->name('orgchartupdatepasukan');
    Route::get('/orgchartcreatepasukan/{idsaluran}',  [OrgMatriksController::class, 'orgchartcreatepasukan'] )->name('orgchartcreatepasukan');
    Route::post('/orgchartstorepasukan/{idsaluran}', [OrgMatriksController::class, 'orgchartstorepasukan'])->name('orgchartstorepasukan');

    //custom route
    Route::get('markas/{id}',   [Markascontroller::class, 'create'])    ->name('markascreate');
    Route::post('markas',       [Markascontroller::class, 'store'])     ->name('markasstore');
    Route::get('/delete/{id}/{saluran_id}/{matrik_id}',  [OrgMatriksController::class, 'destroy'] )   ->name('deletematrik');

    // to update status akaun
    Route::get('/editaktifakaun/{id}',  [UsersController::class, 'editaktifakaun'] )->name('editaktifakaun');
    Route::get('/edittidakaktifakaun/{id}',  [UsersController::class, 'edittidakaktifakaun'] )->name('edittidakaktifakaun');
    Route::get('/userarchive/{id}',  [UsersController::class, 'archiveshow'] )->name('archiveshow');

    // to view report Utama
    Route::get('/reports/view/utama/{id}',  [UtamaController::class, 'carianutama'] )->name('carianutama');
    Route::get('/reports/view/kja/{id}',    [UtamaController::class, 'cariankja'] )         ->name('cariankja');
    Route::get('/reports/view/senjata/{id}',     [UtamaController::class, 'senjata'] )     ->name('senjata');
    Route::get('/reports/view/artileri/{id}',    [UtamaController::class, 'artileri'] )    ->name('artileri');
    Route::get('/reports/view/pasukankhas/{id}', [UtamaController::class, 'pasukankhas'] ) ->name('pasukankhas');



    Route::get('/reports/view/medan/{id}',              [UtamaController::class, 'medan'] )              ->name('medan');
    Route::get('/reports/view/pertahananudara/{id}',    [UtamaController::class, 'pertahananudara'] )    ->name('pertahananudara');


    // to view report dukungan
    Route::get('/reports/view/dukungan/{id}',  [DukunganController::class, 'dukungan'] )  ->name('dukungan');
    Route::get('/reports/view/darat/{id}',     [DukunganController::class, 'darat'] )     ->name('darat');
    Route::get('/reports/view/perairan/{id}',  [DukunganController::class, 'perairan'] )  ->name('perairan');
    Route::get('/reports/view/udara/{id}',     [DukunganController::class, 'udara'] )     ->name('udara');
    Route::get('/reports/view/kjb/{id}',       [DukunganController::class, 'kjb'] )       ->name('kjb');
    Route::get('/reports/view/kjc/{id}',       [DukunganController::class, 'kjc'] )       ->name('kjc');

    // to view report Komunikasi
    Route::get('/reports/view/komunikasi/{id}',  [KomunikasiController::class, 'komunikasi'] )   ->name('komunikasi');
    Route::get('/reports/view/manpack/{id}',     [KomunikasiController::class, 'manpack'] )      ->name('manpack');
    Route::get('/reports/view/vehicular/{id}',   [KomunikasiController::class, 'vehicular'] )    ->name('vehicular');
    Route::get('/reports/view/ArmdComfit/{id}',   [KomunikasiController::class, 'ArmdComfit'] )    ->name('ArmdComfit');


    // to view report Khidmat
    Route::get('/reports/view/khidmat/{id}',         [KhidmatController::class, 'khidmat'] )   ->name('khidmat');
    Route::get('/reports/view/persendirian/{id}',    [KhidmatController::class, 'persendirian'] )    ->name('persendirian');
    //bawah persendirian ada 8 lagi sub
    Route::get('/reports/view/persendirian/item/{pasukan_id}/{subkategori}',        [KhidmatController::class, 'detailpersendirian'] )          ->name('detailpersendirian');
    // Route::get('/reports/view/persendirian/kasuttempur/{id}',   [KhidmatController::class, 'kasuttempur'] )     ->name('kasuttempur');
    // Route::get('/reports/view/persendirian/topiloreng/{id}',    [KhidmatController::class, 'topiloreng'] )      ->name('topiloreng');
    // Route::get('/reports/view/persendirian/webbinglengkap/{id}',[KhidmatController::class, 'webbinglengkap'] )  ->name('webbinglengkap');
    // Route::get('/reports/view/persendirian/jerseypullover/{id}',[KhidmatController::class, 'jerseypullover'] )  ->name('jerseypullover');
    // Route::get('/reports/view/persendirian/stokinghijau/{id}',  [KhidmatController::class, 'stokinghijau'] )    ->name('stokinghijau');
    // Route::get('/reports/view/persendirian/bajutempur/{id}',    [KhidmatController::class, 'bajutempur'] )      ->name('bajutempur');
    // Route::get('/reports/view/persendirian/inner/{id}',         [KhidmatController::class, 'inner'] )           ->name('inner');
    //endsub persendirian
    Route::get('/reports/view/peluru/{id}',         [KhidmatController::class, 'peluru'] )          ->name('peluru');
    Route::get('/reports/view/letupan/{id}',        [KhidmatController::class, 'letupan'] )         ->name('letupan');
    Route::get('/reports/view/jurutera/{id}',       [KhidmatController::class, 'jurutera'] )        ->name('jurutera');
    Route::get('/reports/view/preventif/{id}',      [KhidmatController::class, 'preventif'] )       ->name('preventif');
    Route::get('/reports/view/rangsum/{id}',        [KhidmatController::class, 'rangsum'] )         ->name('rangsum');
    Route::get('/reports/view/pmp/{id}',            [KhidmatController::class, 'pmp'] )             ->name('pmp');
    Route::get('/reports/view/ict/{id}',            [KhidmatController::class, 'ict'] )           ->name('ict');

    //report pasukan
    Route::get('/reports/view/chart',                   [Reportscontroller::class, 'chart'] )                   ->name('chart');
    Route::get('/reports/view/pasukanreport',           [Reportscontroller::class, 'pasukanreport'] )           ->name('pasukanreport');
    Route::get('/reports/view/pasukanviewreport/{id}',  [Reportscontroller::class, 'viewreportpasukangraf'] )   ->name('pasukanviewreport');
    Route::get('/reports/view/markasviewreport/{id}',   [Reportscontroller::class, 'viewreportmarkasgraf'] )    ->name('markasviewreport');

    //pasukan edit tak function, jadi ni ganti untuk route pasukan edit
    Route::get('/pasukan/edit/{id}',     [Pasukancontroller::class, 'edit'] ) ->name('pasukanedit');

    //specialReport
    Route::get('/LaporanKhusus/view/DukunganAir/{id}',    [SpDukunganAirController::class, 'DukunganAir'] )->name('DukunganAir');
    Route::get('/LaporanKhusus/view/{id}',      [SpDukunganAirController::class, 'ListDukungAir'] ) ->name('ListDukungAir');

    //kesemua xboleh guna dan boleh guna
    Route::get('/reports/view/bolehguna/{id}/{pasukan_id}/{previous}',          [UtamaController::class, 'bolehguna'] ) ->name('bolehguna');
    Route::get('/reports/view/tidakbolehguna/{id}/{pasukan_id}/{previous}',      [UtamaController::class, 'tidakbolehguna'] ) ->name('tidakbolehguna');
    Route::get('/reports/view/bolehgunasub/{id}/{pasukan_id}/{previous}',       [UtamaController::class, 'bolehgunasub'] ) ->name('bolehgunasub');
    Route::get('/reports/view/tidakbolehgunasub/{id}/{pasukan_id}/{previous}',  [UtamaController::class, 'tidakbolehgunasub'] ) ->name('tidakbolehgunasub');
    Route::get('/reports/view/bolehgunajenis/{id}/{pasukan_id}/{previous}',     [UtamaController::class, 'bolehgunajenis'] ) ->name('bolehgunajenis');
    Route::get('/reports/view/tidakbolehgunajenis/{id}/{pasukan_id}/{previous}',[UtamaController::class, 'tidakbolehgunajenis'] ) ->name('tidakbolehgunajenis');

    Route::get('/reports/view/pegangan/{id}/{pasukan_id}',      [KhidmatController::class, 'pegangan'] ) ->name('pegangan');
    Route::get('/reports/view/hak/{id}/{pasukan_id}',      [KhidmatController::class, 'hak'] ) ->name('hak');


    Route::get('/reports/view/komunikasiBG/{id}/{pasukan_id}/{previous}',      [KomunikasiController::class, 'komunikasiBG'] ) ->name('komunikasiBG');
    Route::get('/reports/view/komunikasiTBG/{id}/{pasukan_id}/{previous}',      [KomunikasiController::class, 'komunikasiTBG'] ) ->name('komunikasiTBG');
    Route::get('/reports/view/SubkomunikasiBG/{id}/{pasukan_id}/{previous}',      [KomunikasiController::class, 'SubkomunikasiBG'] ) ->name('SubkomunikasiBG');
    Route::get('/reports/view/SubkomunikasiTBG/{id}/{pasukan_id}/{previous}',      [KomunikasiController::class, 'SubkomunikasiTBG'] ) ->name('SubkomunikasiTBG');

    Route::get('/reports/view/spdukunganairBG/{id}',      [SpDukunganAirController::class, 'spdukunganairBG'] ) ->name('spdukunganairBG');
    Route::get('/reports/view/spdukunganairTBG/{id}',     [SpDukunganAirController::class, 'spdukunganairTBG'] ) ->name('spdukunganairTBG');
    Route::get('/reports/view/subspdukunganairBG/{id}',      [SpDukunganAirController::class, 'subspdukunganairBG'] ) ->name('subspdukunganairBG');
    Route::get('/reports/view/subspdukunganairTBG/{id}',     [SpDukunganAirController::class, 'subspdukunganairTBG'] ) ->name('subspdukunganairTBG');


    Route::get('/reports/view/spjutraBG/{id}',      [SpJutraController::class, 'spjutraBG'] ) ->name('spjutraBG');
    Route::get('/reports/view/spjutraTBG/{id}',     [SpJutraController::class, 'spjutraTBG'] ) ->name('spjutraTBG');
    Route::get('/reports/view/subspjutraBG/{id}',      [SpJutraController::class, 'subspjutraBG'] ) ->name('subspjutraBG');
    Route::get('/reports/view/subspjutraTBG/{id}',     [SpJutraController::class, 'subspjutraTBG'] ) ->name('subspjutraTBG');


    Route::get('/reports/view/sputamaBG/{id}',      [SpUtamaController::class, 'sputamaBG'] ) ->name('sputamaBG');
    Route::get('/reports/view/sputamaTBG/{id}',     [SpUtamaController::class, 'sputamaTBG'] ) ->name('sputamaTBG');
    Route::get('/reports/view/subsputamaBG/{id}',      [SpUtamaController::class, 'subsputamaBG'] ) ->name('subsputamaBG');
    Route::get('/reports/view/subsputamaTBG/{id}',     [SpUtamaController::class, 'subsputamaTBG'] ) ->name('subsputamaTBG');

    //carianpantas


});
