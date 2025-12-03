<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\KasirPage;
use App\Livewire\HomePage;
use App\Livewire\Kontak;

Route::get('/about', KasirPage::class)->name('about');
Route::get('/kontak', Kontak::class)->name('kontak');
Route::get('/', HomePage::class)->name('home');
