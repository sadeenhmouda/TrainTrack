<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/traintrack/start', function () {
    return view('traintrack');
})->name('traintrack.start'); // step1

//Updated routes and views for subject and traintrack pages 
Route::get('/subject', function () {
    return view('subject');
})->name('subject');  
 

Route::get('/traintrack', function () {
    return view('traintrack');
})->name('traintrack');

