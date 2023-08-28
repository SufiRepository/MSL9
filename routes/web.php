<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ApplicationController;


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
Route::post('/newlogin',  [LoginController::class, 'authenticate'])->name('newlogin');
Route::get('/getregister',  [RegisterController::class, 'getregister'])->name('getregister');
Route::post('/newregister', [RegisterController::class, 'store'])->name('newregister');
Route::get('/getforgotpassword',  [RegisterController::class, 'getforgotpassword'])->name('getforgotpassword');
//Route::get('/registersuccess',  [NewRegisterController::class, 'registersuccess'])->name('registersuccess');
//Route::get('/contactadmin',  [NewRegisterController::class, 'contactadmin'])->name('contactadmin');
// Route::get('/offline', function () {
//     return view('modules/laravelpwa/offline');    
// });
Route::get('/getapplicationpage', [ApplicationController::class, 'getapplicationpage'])->name('getapplicationpage');
    
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    //larevel route
    Route::resource('roles', RoleController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('users', UserController::class);
    Route::resource('resources', ResourceController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('calendars', CalendarController::class);
    Route::resource('notifications', NotificationController::class);
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
    Route::get('/csvusers',  [UserController::class, 'userscsv'] )->name('userscsv');;
    Route::get('notifications/{notification}',[NotificationController::class,'markAsRead'])->name('notifications.markAsRead');
    Route::delete('notificationsdelete/{id}',[NotificationController::class,'deleteNotification'])->name('notifications.deleteNotification');

    Route::get('projectsarchive', [ProjectController::class, 'indexarchive'])->name('archive');

});
