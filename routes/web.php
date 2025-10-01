<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alumni/login', function () {
    return view('alumni.alumni_login_page');
})->name('alumni.login');

Route::get('/alumni/dashboard', function () {
    return view('alumni.dasboard_alumni');
})->name('alumni.dashboard');