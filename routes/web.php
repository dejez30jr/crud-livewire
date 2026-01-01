<?php

use App\Livewire\Tes;
use App\Livewire\Create;
use App\Livewire\EditPage;
use App\Livewire\HomePage;
use App\Livewire\KasirTraning;
use Illuminate\Support\Facades\Route;

Route::get('/edit-produk/{id}', EditPage::class)->name('product.edit');
Route::get('/create', Create::class)->name('create');
Route::get('/kasir-traning', KasirTraning::class)->name('kasir');
Route::get('/', HomePage::class)->name('home');


