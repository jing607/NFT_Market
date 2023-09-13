<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\NftController;

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

// Route::get('/', function () {
//     return redirect('home');
// });


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cat/{catID?}', [HomeController::class, 'index'])->name('home.cat');

Auth::routes();


// USER
// détaille d'un nft
Route::get('nft/{id}', [NftController::class, 'showNftDetails'])->name('nft.detail');

// user authentifié uniquement
// collection d'user
Route::get('/user/nft/collection', [UserController::class, 'showCollection'])->name('user.collection');

// ajout d'un nft dans la collection du user
Route::get('/user/nft/add/{id}', [UserController::class, 'addToCollection'])->name('user.collection.add');

// suppression d'un nft dans la collection du user
Route::get('/user/nft/remove/{id}', [UserController::class, 'removeFromCollection'])->name('user.collection.remove');


// ADMIN
Route::get('/admin1234/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::post('/admin/auth', [AdminLoginController::class, 'authenticate'])->name('admin.auth');

Route::group(['middleware' => 'admin'], function () {

    Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // liste des users
    Route::get('/admin/users', [AdminController::class, 'adminUserList'])->name('admin.user.list');

    // liste des nfts
    Route::get('/admin/nft', [AdminController::class, 'showNftList'])->name('admin.nft.list');

    // affiche un formulaire de creation de nft
    Route::get('/admin/nft/new', [AdminController::class, 'create'])->name('admin.nft.create');

    // effectue le traitement de creation d'un nft en base de donnée
    Route::post('/admin/nft/store', [AdminController::class, 'store'])->name('admin.nft.store');

    // effectue le traitement en suppression d'un nft en bdd
    Route::get('/admin/nft/delete/{id}', [AdminController::class, 'destroy'])->name('admin.nft.destroy');
});



