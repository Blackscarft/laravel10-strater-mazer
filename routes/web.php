<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect(Route('login'));
});

Auth::routes();

Route::group(
    [
        'middleware' => [
            'auth',
            'role:webmaster|admin'
        ],
    ],
    function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        
        Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/user/new', [UserController::class, 'createUser'])->name('admin.user.new');
        // user route
        Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/user/new', [UserController::class, 'createUser'])->name('admin.user.new');
        Route::post('/user/new', [UserController::class, 'saveCreateUser'])->name('admin.user.create');
        Route::post('/user/reset/{id}', [UserController::class, 'resetPassword'])->name('admin.user.resetPassword');
        Route::post('/user/update-photo', [UserController::class, 'updatePhoto'])->name('admin.user.updatePhoto');
        Route::post('/user/update-profile', [UserController::class, 'updateProfile'])->name('admin.user.updateProfile');
        Route::post('/user/update-password', [UserController::class, 'updatePassword'])->name('admin.user.updatePassword');
        Route::post('/user/update-signature', [UserController::class, 'updateSignature'])->name('admin.user.updateSignature');
        Route::delete('/user/{id}/delete', [UserController::class, 'nonaktif'])->name('admin.user.nonaktif');
    });

