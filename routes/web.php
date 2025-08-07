<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/perro', function () {
    return view('perro'); // Asegúrate de tener esta vista creada
});
Route::post('/', function (Request $request) {
    if ($request->usuario === 'admin' && $request->password === '123') {
        return redirect('/perro');
    } else {
        return back()->with('error', 'Credenciales incorrectas');
    }
});