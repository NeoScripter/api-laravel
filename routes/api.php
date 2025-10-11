<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    $users = User::select(['name', 'email'])->latest()->get();

    return response()->json([
        'users' => $users
    ], 200);
});
