<?php

use App\Livewire\ListMedications;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/medications', ListMedications::class);
