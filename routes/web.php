<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return view('pages.choose-bugs');
});
Route::get('/address', function (){
    return view('pages.address');
});
