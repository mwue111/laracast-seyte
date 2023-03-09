<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        //ddd($newsletter);
        //Validar el mail:
        request()->validate([
            'email' => 'required|email'
        ]);

        //Llamar a la clase newsletter y a su método subscribe:
        try {
            $newsletter->subscribe(request('email'));
        } catch (\Exception $e) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Este correo electrónico no pudo añadirse a la newsletter. Comprueba si es real o si ya estaba suscrito.'
            ]);
        }

        return redirect('/')->with('success', 'Te has suscrito a la newsletter');
    }
}
