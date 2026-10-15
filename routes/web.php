<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageHeroController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Auth\StaffAuthController;
use App\Http\Controllers\DonationPaymentController;
use App\Http\Controllers\AblinerWebhookController;
use App\Http\Controllers\PublicNewsController;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::get('/services/{slug}', function (string $slug) {
    $page = config("service_pages.{$slug}");
    abort_unless($page, 404);

    return view('info.show', [
        'page' => $page,
        'pageType' => 'service',
        'hero' => \App\Support\PageHeroContent::get('service-'.$slug),
        'relatedPages' => config('service_pages'),
        'routeName' => 'services.show',
    ]);
})->name('services.show');
Route::get('/get-involved/{slug}', function (string $slug) {
    $page = config("involvement_pages.{$slug}");
    abort_unless($page, 404);

    return view('info.show', [
        'page' => $page,
        'pageType' => 'involvement',
        'hero' => \App\Support\PageHeroContent::get('involvement-'.$slug),
        'relatedPages' => config('involvement_pages'),
        'routeName' => 'involved.show',
    ]);
})->name('involved.show');
Route::get('/contact', function () {
    return view('contact', ['hero' => \App\Support\PageHeroContent::get('contact')]);
})->name('contact');
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

Route::get('/news', [PublicNewsController::class, 'updates'])->name('news.index');
Route::get('/events', [PublicNewsController::class, 'events'])->name('news.events');
Route::get('/vacancies', [PublicNewsController::class, 'vacancies'])->name('news.vacancies');
Route::get('/news/{slug}', [PublicNewsController::class, 'show'])->name('news.show');

Route::post('/donate/mobile-money', [DonationPaymentController::class, 'store'])->middleware('throttle:5,1')->name('donate.mobile-money');
Route::get('/donate/mobile-money/{donation:public_id}', [DonationPaymentController::class, 'status'])->middleware('throttle:30,1')->name('donate.mobile-money.status');
Route::post('/webhooks/abliner', AblinerWebhookController::class)->name('webhooks.abliner');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [StaffAuthController::class, 'create'])->name('login');
        Route::post('/login', [StaffAuthController::class, 'store'])->middleware('throttle:6,1')->name('login.store');
    });

    Route::middleware('staff:admin,manager')->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::post('/logout', [StaffAuthController::class, 'destroy'])->name('logout');
        Route::resource('content', ContentController::class)->except('show');
        Route::get('/heroes', [PageHeroController::class, 'edit'])->name('heroes.edit');
        Route::put('/heroes/{key}', [PageHeroController::class, 'update'])->name('heroes.update');
        Route::post('/content/{content}/publish', [ContentController::class, 'publish'])->name('content.publish');
        Route::post('/content/{content}/unpublish', [ContentController::class, 'unpublish'])->name('content.unpublish');
    });

    Route::middleware('staff:admin')->group(function () {
        Route::get('/managers', [StaffController::class, 'index'])->name('managers.index');
        Route::post('/managers', [StaffController::class, 'store'])->name('managers.store');
        Route::put('/managers/{user}', [StaffController::class, 'update'])->name('managers.update');
        Route::patch('/managers/{user}/status', [StaffController::class, 'updateStatus'])->name('managers.status');
        Route::get('/donations', [AdminDonationController::class, 'index'])->name('donations.index');
        Route::get('/payment-settings', [AdminDonationController::class, 'settings'])->name('payment-settings.edit');
        Route::put('/payment-settings', [AdminDonationController::class, 'saveSettings'])->name('payment-settings.update');
    });
});
