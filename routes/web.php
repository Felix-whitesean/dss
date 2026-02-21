<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UploadsController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [DashboardController::class , 'index'])->name('admin.dashboard');
Route::get('/', [IndexController::class , 'index'])->name('home');
Route::get('/report', [ReportController::class , 'report'])->name('report');
Route::get('/uploads', [UploadsController::class , 'index'])->name('uploads');
Route::get('/terms', [TermsController::class, 'showTerms'])->name('terms.show');

Route::post('/terms/accept', function () {
    return redirect()->intended("/report")
        ->withCookie(cookie('accepted_terms', true, 24 * 60));
})->name('terms.accept');
