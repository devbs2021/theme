<?php

use DevbShrestha\Theme\Controllers\CMSController;
use DevbShrestha\Theme\Controllers\DashboardController;
use DevbShrestha\Theme\Controllers\MenuController;
use DevbShrestha\Theme\Controllers\RoleController;
use DevbShrestha\Theme\Controllers\SettingController;
use DevbShrestha\Theme\Controllers\SiteController;
use DevbShrestha\Theme\Controllers\SubscriptionController;
use DevbShrestha\Theme\Controllers\TestimonialController;
use DevbShrestha\Theme\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    dd(Theme::sendMail('bharatstha97@gmail.com', 'theme::mail.mail', 'Test Mail', 'Hello world'));

});

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->names('users');
    Route::resource('settings', SettingController::class)->names('settings');
    Route::resource('testimonials', TestimonialController::class)->names('testimonials');
    Route::get('mail', [SubscriptionController::class, 'mail'])->name('mail');
    Route::post('mail', [SubscriptionController::class, 'sendMail'])->name('mail.send');
    Route::resource('subscriptions', SubscriptionController::class)->names('subscriptions');
    Route::resource('cms', CMSController::class)->names('cms');
    Route::resource('menus', MenuController::class)->names('menus');
    Route::get('sites', [SiteController::class, 'index'])->name('sites.index');
    Route::post('sites', [SiteController::class, 'store'])->name('sites.store');
    Route::resource('roles', RoleController::class)->names('roles');

});
