<?php

use Botble\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;
use VigStudio\VigGiscus\Controllers\VigGiscusController;

AdminHelper::registerRoutes(function () {
    Route::group(['prefix' => 'vig-giscus', 'as' => 'vig-giscus.'], function () {
        Route::get('comment', [VigGiscusController::class, 'edit'])->name('settings');
        Route::put('comment', [VigGiscusController::class, 'update'])->name('settings.update');

        Route::post('comment/get-repo', [VigGiscusController::class, 'getData'])->name('settings.repo');
    });
});
