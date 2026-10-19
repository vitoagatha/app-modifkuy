<?php

use App\Http\Controllers\CMSController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/** Content Management System */
Route::get('/', [CMSController::class, 'index'])->name('/');
Route::get('recomendation', [CMSController::class, 'recomendation'])->name('recomendation');
Route::get('{category}/category', [CMSController::class, 'showCategory'])->name('category');
Route::get('{id}/motorcycle', [CMSController::class, 'show'])->name('motorcycle.show');
Route::post('motorcycle/{id}/like', [CMSController::class, 'like'])->name('motorcycle.like');

Route::get('article', [CMSController::class, 'news'])->name('article');
Route::get('help', [CMSController::class, 'help'])->name('help');

/** Authentication */
Auth::routes();

/** Dashboard Administrator */
Route::get('home', 'HomeController@index')->name('home');

Route::get('profile', 'ProfileController@index')->name('profile');
Route::put('profile', 'ProfileController@update')->name('profile.update');

Route::resource('garage', GarageController::class);
Route::get('garage/{id}/add-images', [GarageController::class, 'addImages'])->name('garage.images');
Route::post('garage/{garage_id}/images', [GarageController::class, 'storeImage'])->name('garage.images.store');
Route::put('garage/images/{id}', [GarageController::class, 'updateImage'])->name('garage.images.update');
Route::delete('garage/images/{id}', [GarageController::class, 'deleteImage'])->name('garage.images.delete');

Route::resource('news', NewsController::class);
