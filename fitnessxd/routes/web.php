<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RutinaController;
use App\Http\Controllers\RegistroPesoController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\UserController;

// =============================================
// RUTAS PÚBLICAS (sin autenticación)
// =============================================

// Página raíz - redirige según si está autenticado o no
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
})->name('inicio');

// Login - mostrar formulario
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Login - procesar autenticación
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Registro - mostrar formulario
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Registro - procesar registro
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// =============================================
// RUTAS PROTEGIDAS (requieren autenticación)
// =============================================

Route::middleware('auth')->group(function () {

    // Dashboard - página principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // =========================================
    // PERFIL DE USUARIO
    // =========================================
    Route::get('/perfil', [UserController::class, 'show'])->name('perfil');
    Route::get('/perfil/editar', [UserController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil', [UserController::class, 'update'])->name('perfil.update');

    // =========================================
    // RUTINAS (CRUD completo)
    // =========================================
    // Genera automáticamente:
    // GET    /rutinas               -> index
    // GET    /rutinas/create        -> create
    // POST   /rutinas               -> store
    // GET    /rutinas/{rutina}      -> show
    // GET    /rutinas/{rutina}/edit -> edit
    // PUT    /rutinas/{rutina}      -> update
    // DELETE /rutinas/{rutina}      -> destroy
    Route::resource('rutinas', RutinaController::class);

    // =========================================
    // REGISTRO DE PESO (CRUD completo)
    // =========================================
    Route::resource('registro-pesos', RegistroPesoController::class);

    // =========================================
    // HISTORIAL DE ENTRENAMIENTOS (solo index, create, store, show, destroy)
    // =========================================
    // No incluye edit ni update porque los entrenamientos no se editan
    Route::resource('historial', HistorialController::class)
        ->except(['edit', 'update']);

    // =========================================
    // CERRAR SESIÓN
    // =========================================
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});