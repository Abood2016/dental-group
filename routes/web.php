<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\presencesController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get( '/', [presencesController::class, 'create'])->name('create-presences');
Route::post('/add-presences' ,   [presencesController::class,'store'])->name('add-presences');


Route::group(['prefix' => 'dashboard'], function () {

Route::get('/employee',   [EmployeeController::class, 'index'])->name('employee.index')->middleware('auth');
Route::post( '/employee-store',   [EmployeeController::class, 'store'])->name('employee.store')->middleware('auth');
Route::post('/branch-store',   [EmployeeController::class, 'storeBranchToUser'])->name('branch.store')->middleware('auth');
Route::get('/',   [presencesController::class, 'presencesList'])->name('presences.index')->middleware('auth');

});

Route::get('/login',   [LoginController::class, 'index'])->name('login');
Route::post('/login-store',   [LoginController::class, 'login'])->name('login.store');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

