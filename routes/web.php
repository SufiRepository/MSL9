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

    Route::get('/dashboard/view/{id}',  [HomeController::class, 'carian'] )->name('carian');

    //query get user
    Route::get('/users/filter/{id}',  [UsersController::class, 'byFilter'] )->name('byFilter');

    //custom route
    Route::get('markas/{id}',   [Markascontroller::class, 'create'])    ->name('markascreate');
    Route::post('markas',       [Markascontroller::class, 'store'])     ->name('markasstore');
    Route::get('/delete/{id}/{saluran_id}/{matrik_id}',  [OrgMatriksController::class, 'destroy'] )   ->name('deletematrik');

    // to update status akaun
    Route::get('/editaktifakaun/{id}',  [UsersController::class, 'editaktifakaun'] )->name('editaktifakaun');
    Route::get('/edittidakaktifakaun/{id}',  [UsersController::class, 'edittidakaktifakaun'] )->name('edittidakaktifakaun');
    Route::get('/userarchive/{id}',  [UsersController::class, 'archiveshow'] )->name('archiveshow');

    //pasukan edit tak function, jadi ni ganti untuk route pasukan edit
    Route::get('/pasukan/edit/{id}',     [Pasukancontroller::class, 'edit'] ) ->name('pasukanedit');

  

    //carianpantas


});
