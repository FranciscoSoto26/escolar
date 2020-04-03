<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{


    public function crear()
    {
        return view('registro');
    }

    protected function store(Request $request)
    {
        /*$user = User::create([
            'id_alumno' => '1431901k',
            'nombre' => 'lolo',
            'email' => 'lololo@umich.mx',
            'tipo' => 'alumno',
            'id_programa_educativo' => '1',
        ]);*/

        $data= request()->validate([
            'id_alumno' => 'required|string|max:8',
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'tipo' => 'required|string|max:255',
            'id_programa_educativo' => 'required',
        ]);

        /*DB::table('users')->insert([
            [
             'id_alumno' => $data ['id_alumno'],
             'nombre' => $data['nombre'],
             'email' => $data['email'],
             'tipo' => $data ['tipo'],
             'id_programa_educativo' => $data ['id_programa_educativo'],
            ],
        ]);*/
        User::create([
            'id_alumno' => $data ['id_alumno'],
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'tipo' => $data ['tipo'],
            'id_programa_educativo' => $data ['id_programa_educativo'],

        ]);


        return redirect()->route('home');


    }
}
