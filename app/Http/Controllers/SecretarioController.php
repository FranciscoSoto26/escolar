<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Profesores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SecretarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profesores()
    {
        //$profesores = DB::table('profesores')->orderBy('nombre')->get();
        $profesores = Profesores::all();

        return view('profesores.profesores',compact('profesores'));
    }

    public function edit(Profesores $profesor)
    {
        return view('profesores.edit',['profesor' => $profesor]);
    }

    public function update(Request $request, Profesores $profesor)
    {

        $request->validate([
            'nombre' => '',
            'apaterno' => '',
            'amaterno' => '',
            'grado_maximo' => '',
            'domicilio' => '',
            'sexo' => '',
            'curp' => '',
            'observaciones' => '',
            'cubiculo' => '',
            'extension_avaya' => '',
            'rfc' => '',
            'estado' => '',
            'email'=> '',
        ]);


        $profesor->nombre = $request->nombre;
        $profesor->apaterno = $request->apaterno;
        $profesor->amaterno = $request->amaterno;
        $profesor->grado_maximo = $request->grado_maximo;
        $profesor->domicilio = $request->domicilio;
        $profesor->sexo = $request->sexo;
        $profesor->curp = $request->curp;
        $profesor->observaciones = $request->observaciones;
        $profesor->cubiculo = $request->cubiculo;
        $profesor->extension_avaya = $request->extension_avaya;
        $profesor->rfc = $request->rfc;
        $profesor->estado = $request->estado;
        $profesor->email = $request->email;




        $profesor->save(); // Se guarda el registro en la base de datos.

        return redirect()->route('profesores.profesores')
            ->with('success','User created successfully.');
    }

    public function destroy(Profesores $profesor)
    {
        $profesor->delete();
        return redirect()->route('profesores.profesores');
    }

    public function detalles(Request $request)
    {
        dd($request->get('matricula'));
        $input = $request->all();
        $alu = DB::table('alumnos')->where('id', '=', $input)->get();

    }

    public function buscar(Alumno $alumno)
    {
        return view('alumnos.buscar');
    }
    public function alumnos()
    {
        //$profesores = DB::table('profesores')->orderBy('nombre')->get();
        $alumnos = Alumno::all();

        return view('alumnos.alumnos',compact('alumnos'));
    }


}
