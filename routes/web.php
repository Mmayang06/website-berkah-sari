<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('umat.home');
})->name('home');

Route::get('/about', function () {
    return view('umat.about');
})->name('about');

Route::get('/service', function () {
    return view('umat.service');
})->name('service');

Route::get('/project', function () {
    return view('umat.project');
})->name('project');

Route::get('/feature', function () {
    return view('umat.feature');
})->name('feature');

Route::get('/quote', function () {
    return view('umat.quote');
})->name('quote');

Route::get('/team', function () {
    return view('umat.team');
})->name('team');

Route::get('/testimonial', function () {
    return view('umat.testimonial');
})->name('testimonial');

Route::get('/contact', function () {
    return view('umat.contact');
})->name('contact');
