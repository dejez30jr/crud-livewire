<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\Kontak;
use App\Livewire\EditPage;
use App\Livewire\KasirTraning;

Route::get('/edit-produk/{id}', EditPage::class)->name('product.edit');
Route::get('/kontak', Kontak::class)->name('kontak');
Route::get('/kasir-traning', KasirTraning::class)->name('kasir');
Route::get('/', HomePage::class)->name('home');


