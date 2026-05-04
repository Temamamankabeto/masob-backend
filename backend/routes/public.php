<?php

use Illuminate\Support\Facades\Route;

Route::prefix('public')->group(function () {
    Route::get('/health', function () {
        return response()->json([
            'success' => true,
            'message' => 'eService public health route is working.',
            'time' => now(),
        ]);
    });
});
