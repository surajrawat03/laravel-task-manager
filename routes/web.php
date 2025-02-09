<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {

    Route::prefix('admin')->middleware('role:Admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin-dashboard');

        Route::get('/createUser', [UserController::class, 'create'])->name('create-user');
        Route::post('/storeUser', [UserController::class, 'store'])->name('store-user');
        Route::get('/showUser', [UserController::class, 'index'])->name('admin-show-user');
        Route::post('/showUserTable', [UserController::class, 'showUserTable'])->name('admin-show-user-table');
        Route::get('/editUser/{id}', [UserController::class, 'edit'])->name('edit-user');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update-user');
        Route::post('/delete/{id}', [UserController::class, 'delete'])->name('delete-user');
    });

    Route::prefix('manager')->middleware('role:Manager')->group(function () {
        Route::get('/dashboard', function () {
            return view('manager.dashboard');
        })->name('manager-dashboard');
    });

    Route::prefix('employee')->middleware('role:Employee')->group(function () {
        Route::get('/dashboard', function () {
            return view('employee.dashboard');
        })->name('employee-dashboard');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
