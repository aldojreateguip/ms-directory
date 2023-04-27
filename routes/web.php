<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UbigeoController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\Institution_PersonController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleContorller;
use App\Http\Controllers\RoleController;
use Faker\Guesser\Name;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index']);

Route::middleware(['guest'])->group(function () {
    //Login
    Route::get('login', [LoginController::class, 'show'])->name('login');
    Route::post('auth-credentials', [LoginController::class, 'authenticate'])->name('authenticate');

    //register
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('new-register', [RegisterController::class, 'store'])->name('newregister');
});


Route::middleware(['auth'])->group(function () {
    /**
     * Logout Route
     */
    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

    //Ubigeo
    Route::get('ubigeo', [UbigeoController::class, 'index']);
    Route::post('add-ubigeo', [UbigeoController::class, 'store']);
    Route::get('edit-ubigeo/{id}', [UbigeoController::class, 'edit']);
    Route::put('update-ubigeo/', [UbigeoController::class, 'update']);
    Route::delete('delete-ubigeo/', [UbigeoController::class, 'destroy']);
    //Person
    Route::get('person', [PersonController::class, 'index']);
    Route::post('add-person', [PersonController::class, 'store']);
    Route::get('edit-person/{id}', [PersonController::class, 'edit']);
    Route::put('update-person', [PersonController::class, 'update']);
    Route::delete('delete-person', [PersonController::class, 'destroy']);
    //Person
    Route::get('institution', [InstitutionController::class, 'index']);
    Route::post('add-institution', [InstitutionController::class, 'store']);
    Route::get('edit-institution/{id}', [InstitutionController::class, 'edit']);
    Route::put('update-institution', [InstitutionController::class, 'update']);
    Route::delete('delete-institution', [InstitutionController::class, 'destroy']);
    //Person
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::post('add-user', [UserController::class, 'store']);
    Route::get('edit-user/{id}', [UserController::class, 'edit']);
    Route::put('update-user', [UserController::class, 'update']);
    Route::put('delete-user/{id}', [UserController::class, 'delete']);
    Route::get('user/get-roles/{id}', [RoleController::class, 'get_roles'])->name('getroles');
    Route::put('user/change_role_state/{id}', [RoleController::class, 'change_role_user_state']);
    Route::get('user/show_add_role', [RoleController::class, 'show_add_role']);
    Route::post('user/add_role', [RoleController::class, 'add_role']);
    //Person
    Route::get('institution_person', [Institution_PersonController::class, 'index']);
    Route::post('add-institution_person', [Institution_PersonController::class, 'store']);
    Route::get('edit-institution_person/{id}', [Institution_PersonController::class, 'edit']);
    Route::put('update-institution_person', [Institution_PersonController::class, 'update']);
    Route::delete('delete-institution_person', [Institution_PersonController::class, 'destroy']);

    //Role
    Route::get('role', [RoleController::class, 'index'])->name('role');
    Route::get('role/datatable/data', [RoleController::class, 'get_role_dttable'])->name('get_role_dttable');
    Route::put('role/update', [RoleController::class, 'update_role']);
    Route::get('get-role-data/{id}', [RoleController::class, 'get_role_data']);
    Route::post('create-role', [RoleController::class, 'create'])->name('newrole');
    Route::get('check-role', [RoleController::class, 'check_role'])->name('checkrole');
    Route::put('delete-role/{id}', [RoleController::class, 'del_role'])->name('delrole');
    Route::put('role/change-state/{id}', [RoleController::class, 'change_role_state']);

    Route::get('show-permission', [PermissionController::class, 'show'])->name('showpermission');
    Route::post('asign-permission', [PermissionController::class, 'asign_permission']);

    //postlogin
    Route::get('mainboard', [PermissionController::class, '__construct'])->name('mainboard');
});



// Route::get('/1', function () {
//     return view('readme');
// });
