<?php


use App\Http\Controllers\AvisoController;
use App\Http\Controllers\CardapioController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\UserController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/quem-somos', [HomeController::class, 'quem_somos'])->name('quem.somos');
Route::get('/etiquetas-escolares', [HomeController::class, 'etiquetas_escolares'])->name('etiquetas.escolares');
Route::get('/nossos-links', [HomeController::class, 'nossos_links'])->name('nossos.links');

/* ROTAS ADMINISTRATIVAS */
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::put('users/{user}', [UserController::class, 'update'])->name('user.update');

        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions');
        Route::post('permissions', [PermissionController::class, 'store'])->name('permission.store');
        Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permission.update');
        Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');

        Route::get('roles', [RoleController::class, 'index'])->name('roles');
        Route::post('roles', [RoleController::class, 'store'])->name('role.store');
        Route::put('roles/{role}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('role.destroy');

        Route::get('setores', [SetorController::class, 'index'])->name('setores');
        Route::post('setores', [SetorController::class, 'store'])->name('setor.store');
        Route::put('setores/{setor}', [SetorController::class, 'update'])->name('setor.update');
        Route::delete('setores/{setor}', [SetorController::class, 'destroy'])->name('setor.destroy');

        Route::get('avisos', [AvisoController::class, 'index'])->name('avisos');
        Route::post('avisos', [AvisoController::class, 'store'])->name('aviso.store');
        Route::put('avisos/{aviso}', [AvisoController::class, 'update'])->name('aviso.update');
        Route::delete('avisos/{aviso}', [AvisoController::class, 'destroy'])->name('aviso.destroy');



    });
