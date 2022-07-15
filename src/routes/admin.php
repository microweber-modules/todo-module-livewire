<?php

Route::name('admin.todo-module-livewire.')
    ->prefix(ADMIN_PREFIX . '/todo-module-livewire')
    ->middleware(['admin'])
    ->namespace('MicroweberPackages\Modules\TodoModuleLivewire\Http\Controllers\Admin')
    ->group(function () {
        Route::get('/index', 'AdminController@index')->name('index');
    });
