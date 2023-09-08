<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('home');

// USER
Route::get('/user/login', [UserController::class, 'login'])->name('user.login');
Route::get('/user/register', [UserController::class, 'create'])->name('user.register');
Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');


// liste des nfts
Route::get('/nft', [NftController::class, 'index'])->name('nft.list');

// liste des nfts filtrés par catégory
Route::get('/nft/{category_id}/category', [NftController::class, 'show'])->name('nft.category');

// détaille d'un nft
Route::get('/nft/{id}', [NftController::class, 'show'])->name('nft.detail');

// collection d'user
Route::get('/nft/{id}/user', [UserController::class, 'show'])->name('user.mycollection');




// ADMIN
Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// liste des users
Route::get('/admin/user', [AdminController::class, 'show'])->name('user.list');

// liste des nfts
Route::get('/admin/nft', [AdminController::class, 'show'])->name('nft.list');

// affiche un formulaire de creation de nft
Route::get('/admin/nft/new', [AdminController::class, 'create'])->name('admin.create');

// effectue le traitement de creation d'un nft en base de donnée
Route::post('/admin/nft', [AdminController::class, 'store'])->name('admin.store');

// affiche le formulaire en modification d'un nft
Route::get('/admin/nft/edit', [AdminController::class, 'edit'])->name('admin.edit');

// effectue le traitement en modification d'un nft en bdd
Route::post('/admin/nft}', [AdminController::class, 'update'])->name('admin.update');

// effectue le traitement en suppression d'un nft en bdd
Route::delete('/admin/nft', [AdminController::class, 'destroy'])->name('admin.destroy');
