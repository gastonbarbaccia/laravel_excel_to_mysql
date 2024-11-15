<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('import');
});

Route::get('/info', function () {
    return view('info');
});

Route::post('/import-users', [UserController::class, 'import'])->name('users.import');


