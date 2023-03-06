<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function create() {
        return view('register.create');
    }

    public function store() {

       $attributes = request()->validate([
            'name' => 'required|max:255|min:2',
            'username' => 'required|max:255|min:2|unique:users,username',   //mira en la columna username en la tabla users y comprueba si es unique
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:7'
       ]);

       //Encriptar contraseñas:
       //Una opción:
       //$attributes['password'] = bcrypt($attributes['password']);
       //Otra opción: eloquent mutator en User.php. Se define una función setPasswordAttributes y se le indica que attributes['password'] se tiene que guardar de X manera en la base de datos.

       //Crear el usuario en la base de datos:
       $user = User::create($attributes);

       //Informar al usuario (se sustituye porp with en el return):
       //session()->flash('success', 'Tu cuenta se ha creado.');

       //Logear al usuario:
        auth()->login($user);

       return redirect('/')->with('success', 'Tu cuenta se ha creado.');
    }
}
