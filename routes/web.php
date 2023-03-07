<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MainController;


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
    return view('welcome');
});

Route::get('/dashboard', [MainController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    //Profile
    Route::group([
        'prefix' => 'profile'
    ], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //Services
    Route::group([
        'prefix' => 'service'
    ], function () {
        Route::get('/new', [ServiceController::class, 'new'])->name('service.new');
        Route::post('/create', [ServiceController::class, 'create'])->name('service.create');

        //Chat
        Route::get('/{service_id}/chat/{id?}', [ChatController::class, 'show'])->name('chat.show');
        Route::post('/{service_id}/chat/{id}', [ChatController::class, 'send'])->name('chat.send');        
    
    });
});

require __DIR__.'/auth.php';
