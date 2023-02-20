<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\CalendarController;


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

// Route::get('/offline', function () {
//     return view('modules/laravelpwa/offline');    
// });
    
Route::get('/dashboard',  [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::post('/newlogin',  [LoginController::class, 'authenticate'])->name('newlogin');
//Route::post('/newregister',  [NewRegisterController::class, 'store'])->name('newregister');
//Route::get('/registersuccess',  [NewRegisterController::class, 'registersuccess'])->name('registersuccess');
//Route::get('/contactadmin',  [NewRegisterController::class, 'contactadmin'])->name('contactadmin');
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

Route::group(['middleware' => ['auth']], function() {
    //larevel route
    Route::resource('roles', RoleController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('users', UserController::class);
    Route::resource('resources', ResourceController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('calendars', CalendarController::class);
    Route::get('/tasklist',  [TaskController::class, 'tasklist'] );

    Route::get('/dashboard/view/{id}',  [HomeController::class, 'carian'] )->name('carian');

    //query get user
    Route::get('/users/filter/{id}',  [UserController::class, 'byFilter'] )->name('byFilter');

    // to update status akaun
    Route::get('/editaktifakaun/{id}',  [UserController::class, 'editaktifakaun'] )->name('editaktifakaun');
    Route::get('/edittidakaktifakaun/{id}',  [UserController::class, 'edittidakaktifakaun'] )->name('edittidakaktifakaun');
    Route::get('/userarchive/{id}',  [UserController::class, 'archiveshow'] )->name('archiveshow');

    //pasukan edit tak function, jadi ni ganti untuk route pasukan edit
    Route::get('/pasukan/edit/{id}',     [Pasukancontroller::class, 'edit'] ) ->name('pasukanedit');

  

    Route::get('/file-import',[UserController::class,'importView'])->name('import-view');
    Route::post('/import',[UserController::class,'import'])->name('import');
    Route::get('/export-users',[UserController::class,'exportUsers'])->name('export-users');
    Route::get('/userscsv',  [UserController::class, 'userscsv'] )->name('userscsv');;

});
