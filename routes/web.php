<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/login', function () {
    return view('Auth.login');
});

Route::get('/register', function () {
    return view('Auth.register');
});

Route::get('/forget-password', function () {
    return view('Auth.forget-password');
});

Route::get('/reset-password', function () {
    return view('Auth.reset-password');
});

Route::get('/user-dashboard', function () {
    return view('User.dashboard');
});

Route::get('/viewexam', function () {
    return view('User.Viewexam');
});

Route::get('/viewresult', function () {
    return view('User.Viewresult');
});

Route::get('/exampage', function () {
    return view('User.Exampage');
});

Route::get('/manage-topics', function () {
    return view('Admin.manage-topics');
});

