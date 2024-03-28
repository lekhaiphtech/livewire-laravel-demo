<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\FormComponent;


Route::get('/', FormComponent::class)->name('form');
