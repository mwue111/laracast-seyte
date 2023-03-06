<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create(){

        return view('sessions.create');
    }

    public function store() {

        //validar los datos:
        $attributes = request()->validate([
            //'email' => 'required|exists:users,email',   //buscar en la tabla users, columna email el dato que coincida con este email
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Intentar iniciar sesión: usar attempt() y los datos validados
        if(auth()->attempt($attributes)) {
            session()->regenerate();    //Para impedir ataques de session fixation
            return redirect('/')->with('success', '¡Bienvenido/a de vuelta!');
        }

        //Si falla la autenticación:
        //Una opción:
        // return back()
        //     ->withInput()   //Para repopular el formulario
        //     ->withErrors(['email' => 'Datos incorrectos.']);    //mensaje genérico

        //Otra opción: impostanto ValidationException
        throw ValidationException::withMessages([
            'email' => 'Las credenciales no coinciden.'
        ]);

    }

    public function destroy() {

        auth()->logout();

        return redirect('/')->with('success', '¡Adiós!');
    }
}
