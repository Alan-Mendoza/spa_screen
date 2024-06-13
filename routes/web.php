<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/get-permissions', function () {
    return auth()->check() ? auth()->user()->jsPermissions() : 0;
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Ruta de documentos
    Route::resource('documents', DocumentController::class);
    // Ruta de Permisos
    Route::resource('permissions', PermissionController::class);
    // Ruta de Roles
    Route::resource('roles', RoleController::class);
    // Ruta de Usuarios
    Route::resource('users', UserController::class);
});
