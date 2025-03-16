<?php

use App\Http\Controllers\ChatAppController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/achat', function () {
    return view('achat');
});

Route::get('/chat', function () {
    return view('chat');
});

Route::post('/chat', [ChatAppController::class,'chatapp'])->name('chatapp');

Route::post('/firemsg', [ChatAppController::class,'firemsg'])->name('firemsg');