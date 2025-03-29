<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/traintrack/start', function () {
    return view('traintrack');
})->name('traintrack.start'); // step1



Route::get('/traintrack/subject', function () {
    return view('subject');
})->name('traintrack.subject'); //step2 

