<?php

use App\Http\Controllers\Admin\TodoController;
use Illuminate\Support\Facades\Route;




Route::group(['prefix' => 'todo'], function() {
    Route::post('create', [TodoController::class, 'Create']);
    Route::post('list', [TodoController::class, 'List']);
    Route::post('update', [TodoController::class, 'Update']);
    Route::post('delete', [TodoController::class, 'Delete']);
});
