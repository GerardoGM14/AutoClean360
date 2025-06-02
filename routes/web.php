<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::get('/', fn() => redirect('/login'));

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', fn() => view('dashboard'));
Route::get('/superadmin', fn() => view('superadmin'));


Route::get('/clientes', function () {
    return view('admin.clientes');
})->name('clientes.index');

Route::get('/clientes/crear', function () {
    return view('admin.crear-cliente');
})->name('clientes.crear');

// Ruta protegida para cliente
Route::get('/cliente/dashboard', function () {
    return view('cliente.cliente'); // o 'cliente.dashboard' si lo renombras
});


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/cliente/nueva-cita', function () {
    return view('cliente.solicitar-cita');
})->name('cliente.solicitar-cita');

Route::get('/cliente/mis-solicitudes', function () {
    return view('cliente.mis-solicitudes'); // Asegúrate que el archivo esté renombrado correctamente
})->name('cliente.solicitudes');

// Vista de citas para el administrador
Route::get('/citas', function () {
    return view('admin.citas'); // Coincide con la vista citas.blade.php
})->name('admin.citas');

Route::get('/ubicacion', function () {
    return view('admin.ubicacion');
})->name('admin.ubicacion');

Route::get('/superadmin/dashboard', function () {
    return view('superadmin.dashboard');
});

Route::get('/cliente/ubicacion', function () {
    return view('cliente.ubicacion');
});