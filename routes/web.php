<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return view('pages.choose-bugs');
});
Route::get('/address', function (){
    return view('pages.address');
});
Route::get('/user-info', function (){
    return view('pages.user-info');
});
Route::get('/plans', function (){
    return view('pages.plans');
});
Route::get('/payment-info', function (){
    return view('pages.payments');
});
Route::get('/appointment', function (){
    return view('pages.appointment');
});
Route::get('/success', function (){
    return view('pages.success');
});
