<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::get('/programs', function () {
    return view('programs.index', ['programs' => config('programs')]);
})->name('programs.index');
Route::get('/programs/{slug}', function (string $slug) {
    $program = config("programs.{$slug}");

    abort_unless($program, 404);

    return view('programs.show', [
        'slug' => $slug,
        'program' => $program,
        'programs' => config('programs'),
    ]);
})->name('programs.show');
