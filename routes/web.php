<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Custom authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [CustomAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CustomAuthController::class, 'login']);
    Route::get('/register', [CustomAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [CustomAuthController::class, 'register']);
});

// Custom authentication routes
Route::get('/auth/login', [CustomAuthController::class, 'showLoginForm'])->name('custom.login');
Route::post('/auth/login', [CustomAuthController::class, 'login']);
Route::get('/auth/register', [CustomAuthController::class, 'showRegisterForm'])->name('custom.register');
Route::post('/auth/register', [CustomAuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/dosen', [DashboardController::class, 'dosen'])->name('dashboard.dosen');
    Route::get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswa'])->name('dashboard.mahasiswa');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dummy route for profile.edit
    Route::get('/profile/edit', function () {
        // Anda bisa ganti dengan view atau controller sesuai kebutuhan
        return view('profile.edit');
    })->name('profile.edit');
    
    // Task Routes
    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/toggle-complete', [TaskController::class, 'toggleComplete'])
        ->name('tasks.toggle-complete');
    
    // Collaborator Routes
    Route::get('/tasks/{task}/collaborators', [CollaboratorController::class, 'index'])
        ->name('collaborators.index');
    Route::get('/tasks/{task}/collaborators/create', [CollaboratorController::class, 'create'])
        ->name('collaborators.create');
    Route::post('/tasks/{task}/collaborators', [CollaboratorController::class, 'store'])
        ->name('collaborators.store');
    Route::delete('/tasks/{task}/collaborators/{user}', [CollaboratorController::class, 'destroy'])
        ->name('collaborators.destroy');
    
    // File Routes
    Route::get('/tasks/{task}/files', [FileController::class, 'index'])
        ->name('files.index');
    Route::get('/tasks/{task}/files/create', [FileController::class, 'create'])
        ->name('files.create');
    Route::post('/tasks/{task}/files', [FileController::class, 'store'])
        ->name('files.store');
    Route::get('/tasks/{task}/files/{file}', [FileController::class, 'show'])
        ->name('files.show');
    Route::delete('/tasks/{task}/files/{file}', [FileController::class, 'destroy'])
        ->name('files.destroy');
});

require __DIR__.'/auth.php';