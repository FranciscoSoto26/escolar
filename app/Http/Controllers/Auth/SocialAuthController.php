<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialAuthController extends Controller
{
    // Metodo encargado de la redireccion
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider)
    {
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->user();


        // Comprobamos si el usuario ya existe
        if ($user = User::where('email', $social_user->email)->first()) {

            if($user->avatar == Null ){
                $user->avatar = $social_user->avatar;
                $user->save();
            }

            return $this->authAndRedirect($user); // Login y redirección
        } else {
            // En caso de que no exista lo regresamos a la pantalla de inicio.


            return redirect()->to('/login');
        }
    }
    // Login y redirección
    public function authAndRedirect($user)
    {

        Auth::login($user);
        //$user=User::with('alumnos');

        return redirect()->to('/home');
    }
}
