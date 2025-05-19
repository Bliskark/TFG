<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\PokedexController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\BattleController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\EventoController;

require __DIR__.'/auth.php';

// Página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Estadísticas
Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');

// Pokédex
Route::get('/pokedex', [PokedexController::class, 'index'])->name('pokedex.index');
Route::get('/pokedex/{id}', [PokedexController::class, 'show'])->name('pokedex.show');

// Rutas protegidas (requiere auth)
Route::middleware('auth')->group(function () {
    // Equipo
    Route::get('/equipo',         [EquipoController::class, 'index'])->name('equipo.index');
    Route::get('/equipo/create',  [EquipoController::class, 'create'])->name('equipo.create');
    Route::post('/equipo',        [EquipoController::class, 'store'])->name('equipo.store');
    Route::get('/equipo/edit',    [EquipoController::class, 'edit'])->name('equipo.edit');
    Route::put('/equipo',         [EquipoController::class, 'update'])->name('equipo.update');

    // Combate
    Route::get('/battle',         [BattleController::class, 'show'])->name('battle.show');
    Route::post('/battle/start',  [BattleController::class, 'start'])->name('battle.start');
    Route::get('/battle/fight',   [BattleController::class, 'fight'])->name('battle.fight');
    Route::post('/battle/action', [BattleController::class, 'action'])->name('battle.action');
    Route::get('/battle/result',  [BattleController::class, 'result'])->name('battle.result');
});

// Panel de administración (requiere rol admin)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Usuarios
    Route::get('/usuarios',                 [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create',          [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios',                [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id}/edit',       [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}',            [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}',         [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

    // Equipo de usuarios
    Route::get('/usuarios/{id}/equipo',     [UsuarioController::class, 'equipo'])->name('usuarios.equipo');
    Route::get('/usuarios/{id}/equipo/edit',[UsuarioController::class,'editEquipo'])->name('usuarios.equipo.edit');
    Route::put('/usuarios/{id}/equipo',     [UsuarioController::class, 'updateEquipo'])->name('usuarios.equipo.update');

    // Eventos
    Route::get('/eventos',                  [EventoController::class,   'index'])->name('eventos.index');
    Route::get('/eventos/create',           [EventoController::class,   'create'])->name('eventos.create');
    Route::post('/eventos',                 [EventoController::class,   'store'])->name('eventos.store');
    Route::get('/eventos/{evento}/edit',    [EventoController::class,   'edit'])->name('eventos.edit');
    Route::put('/eventos/{evento}',         [EventoController::class,   'update'])->name('eventos.update');
    Route::delete('/eventos/{evento}',      [EventoController::class,   'destroy'])->name('eventos.destroy');
});
