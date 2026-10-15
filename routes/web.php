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
Route::get('/childhood-cancer', function () {
    return view('cancer.index', ['topics' => config('cancer_topics')]);
})->name('cancer.index');
Route::get('/childhood-cancer/{slug}', function (string $slug) {
    $topic = config("cancer_topics.{$slug}");

    abort_unless($topic, 404);

    return view('cancer.show', [
        'slug' => $slug,
        'topic' => $topic,
        'topics' => config('cancer_topics'),
    ]);
})->name('cancer.show');
