<?php

use Illuminate\Support\Facades\Route;
use GrassFeria\StarterkidService\Livewire\Service\ServiceEdit;
use GrassFeria\StarterkidService\Livewire\Service\ServiceIndex;
use GrassFeria\StarterkidService\Livewire\Service\ServiceCreate;
use GrassFeria\StarterkidService\Livewire\Front\Service\FrontServiceShow;
use GrassFeria\StarterkidService\Livewire\Front\Service\FrontServiceIndex;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['web'])->group(function () {
   
    
    Route::get(config('starterkid-service.service_slug'),FrontServiceIndex::class)->name('front.service.index')->middleware('minify');
    Route::get(config('starterkid-service.service_slug').'/{slug}',FrontServiceShow::class)->name('front.service.show')->middleware('minify','cache');
    
   
   

});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
   
    Route::get('/dashboard/services',ServiceIndex::class)->name('services.index');
    Route::get('/dashboard/services/create',ServiceCreate::class)->name('services.create');
    Route::get('/dashboard/services/edit/{recordId}',ServiceEdit::class)->name('services.edit');

    


   
});