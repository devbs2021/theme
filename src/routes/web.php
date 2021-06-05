<?php

use Devbs\Theme\Controllers\DashboardController;
use Devbs\Theme\Controllers\UserController;
use Devbs\Theme\Controllers\SettingController;
use Devbs\Theme\Controllers\TestimonialController;
use Devbs\Theme\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('test', function () {
  dd(Theme::sendMail('bharatstha97@gmail.com','theme::mail.mail','Test Mail','Hello world'));

});

Route::group(['middleware' => ['web','auth']], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->names('users');
    Route::resource('settings', SettingController::class)->names('settings');
    Route::resource('testimonials', TestimonialController::class)->names('testimonials');
    Route::get('mail', [SubscriptionController::class,'mail'])->name('mail');
    Route::post('mail', [SubscriptionController::class,'sendMail'])->name('mail.send');
    Route::resource('subscriptions', SubscriptionController::class)->names('subscriptions');

    
});
