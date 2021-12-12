<?php

foreach (array_reverse(config('inweb.languages')) as $locale) {
    $prefix = $locale == config('inweb.default_language') ? null : $locale;

    Route::group(['prefix' => $prefix, 'as' => $locale . ':'], function () use ($locale) {
        Route::get('', [\App\Http\Controllers\PageController::class, 'index'])->name('index');

        Route::get('{page}', [\App\Http\Controllers\PageController::class, 'page'])->where('page', '^(?!' . config('admin.path') . ')(.)*$')->name('page');
    });
}
