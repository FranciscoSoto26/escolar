<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['alumno', 'admin', 'secac']);
        $request->user()->hasRole('admin');

        return view('home');
    }

    public function escogerm(Request $request)
    {
        $request->user();

        $estatus = DB::table('alumnos')
            ->select('estado')
            ->where('id', '=', Auth::user()->id_alumno)
            ->get();

        if ($estatus[0]->estado == "ART_34" or $estatus[0]->estado == "BAJA"){
            abort(401);
        }


// Your code here!
//Materias
 /*       $array = array(
            "id" => 1,
            "materia" => "calculo l",
        );
        $array2 = array(
            "id" => 2,
            "materia" => "calculo 2",
        );
        $array3 = array(
            "id" => 3,
            "materia" => "calculo 3",
        );

//materia con prerequisito
        $array4 = array(
            "id" => 2,
            "materia" => "calculo 2",
            "prerequisito" => 1
        );

        $array5 = array(
            "id" => 3,
            "materia" => "calculo 3",
            "prerequisito" => 1
        );
        $array6 = array(
            "id" => 3,
            "materia" => "calculo 3",
            "prerequisito" => 2
        );

//kardex  con id de materia
        $array7 = array(
            "id" => 1,
            "materia" => "calculo l",
        );

//materias
        $materias = array();
        array_push($materias, $array);
        array_push($materias, $array2);
        array_push($materias, $array3);

//materias con prerequisito
        $matpre = array();
        array_push($matpre, $array4);
        array_push($matpre, $array5);
        array_push($matpre, $array6);


//kardex
        $kardex = array();
        array_push($kardex, $array7);
*/
 //Total de materias
 $mates=DB::table('materias')->where("cla","like","%T")->orderBy('materia')->get();

 //incritoss
        $inscritos = DB::table(DB::raw("(SELECT * FROM `inscritos` where id_alumno = '".Auth::user()->id_alumno."') inscritos INNER JOIN grupos on inscritos.id_grupo = grupos.id"))->get();

 //Materias con prerequisitos
        $matpre = DB::table(DB::raw("(SELECT * FROM materias LEFT JOIN prerequisitos ON materias.id = prerequisitos.id_materia WHERE prerequisitos.id_prerequisito is not null) as loquesea" ))->get();

        //Kardex
        $kardex = DB::table(DB::raw("(SELECT * FROM `kardex` where examen is not null and calificacion > 5 and id_alumno = '".Auth::user()->id_alumno."') kardex INNER JOIN grupos on grupos.id = kardex.id_grupo" ))->get();

        //Creditos del alumno
        $creditos = DB::table(DB::raw("(SELECT SUM(creditos) as creditos FROM (SELECT * FROM `kardex` where examen is not null and calificacion >  5 and id_alumno = \"1431901k\") kardex INNER JOIN grupos on grupos.id = kardex.id_grupo INNER JOIN (SELECT * FROM materias where cla LIKE '%T' )  materias ON
id_materia = materias.id) as creditos" ))->get();

        $creditostotales = DB::table('programas_educativos')
            ->select('creditos_totales')
            ->where('id', '=', Auth::user()->id_programa_educativo)
            ->get();

        $creditosreglade3= (((int)$creditos[0]->creditos)*100)/((int)$creditostotales[0]->creditos_totales);

        $materias = array();
        foreach ($mates as $mate) {
            $pasoMateria = false;
            foreach ($kardex as $kar) {
                if ($mate->id == $kar->id_materia) { //si la materia esta en kardex es por que ya la pase entonces no la muestro
                    $pasoMateria = true;
                }
            }
            if ($pasoMateria) {
                continue;
            }
            //Obtener los prerequisitos
            $pre = array();
            foreach ($matpre as $mat) {
                if ($mat->id == $mate->id) {
                    array_push($pre, $mat);
                }
            }
            //validar que se pasaron los prerequisitos
            $cantPre = 0;
            $cantPrePasados = 0;
            foreach ($pre as $pr) {
                foreach ($kardex as $kar) {
                    if ($pr->id_prerequisito == $kar->id_materia) {
                        $cantPrePasados++;
                    }
                }
                $cantPre++;

            }
            $seleccionoMateria=true;
            foreach ($inscritos as $inscrito){
                if ($mate->id == $inscrito->id_materia) { //si la materia esta en kardex es por que ya la pase entonces no la muestro
                    $seleccionoMateria = false;
                }
            }


            if ($cantPre == $cantPrePasados and $creditosreglade3 >= $mate->precreditos and $seleccionoMateria) {

                array_push($materias, $mate);
            }


        }




        //$materias2 = DB::table('materias')->orderBy('materia')->get();
        $materias2 = DB::table(DB::raw("(SELECT * FROM `kardex` where examen is not null and calificacion > 5) kardex INNER JOIN grupos on grupos.id = kardex.id_grupo RIGHT JOIN (SELECT * FROM materias where cla LIKE '%T' )  materias ON
id_materia = materias.id where id_materia is null" ))->orderBy('materia')->get();
        //var_dump($materias);
        $request->user()->authorizeRoles(['admin']);
        $request->user()->hasRole('admin');
        $prom = DB::table('alumnos')->select("prom_ant")->where('id', '=', Auth::user()->id_alumno)->get();
        $fecha = DB::table('fechaseleccion')->where('promedio', '=', $prom[0]->prom_ant)->get();
        $fechaactual=date("Y-m-d H:i:s");

        $bandera=true;

        $fechabase=$fecha[0];

        switch ($prom[0]->prom_ant){
            case 10:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 9:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 8:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 7:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 6:$request->user();

        $estatus = DB::table('alumnos')
            ->select('estado')
            ->where('id', '=', Auth::user()->id_alumno)
            ->get();

        if ($estatus[0]->estado == "ART_34" or $estatus[0]->estado == "BAJA"){
            abort(401);
        }
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 5:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;

                }
                break;
            case 4:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 3:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 2:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 1:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 0:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case -1:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
        }

        if ($bandera){
            abort(401);
        }

        //$materias = DB::table('materias')->orderBy('materia')->get();

        return view('escogem',compact('materias'));
    }

    public function escogerl(Request $request)
    {
        $request->user();

        $estatus = DB::table('alumnos')
            ->select('estado')
            ->where('id', '=', Auth::user()->id_alumno)
            ->get();

        if ($estatus[0]->estado == "ART_34" or $estatus[0]->estado == "BAJA") {
            abort(401);
        }

        //Total de materias
        $mates = DB::table('materias')->where("cla", "like", "%L")->orderBy('materia')->get();

        $mateT=DB::table('materias')->where("cla","like","%T")->orderBy('materia')->get();
        //incritoss
        $inscritos = DB::table(DB::raw("(SELECT id_alumno,cla,id_materia FROM (SELECT * FROM `inscritos` where id_alumno = '".Auth::user()->id_alumno."') inscritos INNER JOIN grupos on inscritos.id_grupo = grupos.id INNER JOIN  materias on materias.id = id_materia ) mat INNER JOIN materias ON SUBSTRING(mat.cla,1,6) = 'CB0100'"))->get();




        //Materias con prerequisitos
        $matpre = DB::table(DB::raw("(SELECT * FROM materias LEFT JOIN prerequisitos ON materias.id = prerequisitos.id_materia WHERE prerequisitos.id_prerequisito is not null) as loquesea" ))->get();

        //Kardex
        $kardex = DB::table(DB::raw("(SELECT * FROM `kardex` where examen is not null and calificacion > 5 and id_alumno = '".Auth::user()->id_alumno."') kardex INNER JOIN grupos on grupos.id = kardex.id_grupo" ))->get();

        $materias = array();
        foreach ($mates as $mate) {
            $pasoMateria = false;
            foreach ($kardex as $kar) {
                if ($mate->id == $kar->id_materia) { //si la materia esta en kardex es por que ya la pase entonces no la muestro
                    $pasoMateria = true;
                }
            }
            if ($pasoMateria) {
                continue;
            }
            //Obtener los prerequisitos
            $pre = array();
            foreach ($matpre as $mat) {
                if ($mat->id == $mate->id) {
                    array_push($pre, $mat);
                }
            }
            //validar que se pasaron los prerequisitos
            $cantPre = 0;
            $cantPrePasados = 0;
            foreach ($pre as $pr) {
                foreach ($kardex as $kar) {
                    if ($pr->id_prerequisito == $kar->id_materia) {
                        $cantPrePasados++;
                    }
                }
                $cantPre++;

            }
            $seleccionoMateria=true;
            foreach ($inscritos as $inscrito){
                if ($mate->id == $inscrito->id_materia) { //si la materia esta en kardex es por que ya la pase entonces no la muestro
                    $seleccionoMateria = false;
                }
            }

            //validar que la materia de la que depende el laboratorio este en inscritos
            $matertomada=false;
            $inscritos = DB::table(DB::raw("(SELECT id_alumno,cla,id_materia FROM (SELECT * FROM `inscritos` where id_alumno = '".Auth::user()->id_alumno."') inscritos INNER JOIN grupos on inscritos.id_grupo = grupos.id INNER JOIN  materias on materias.id = id_materia ) mat INNER JOIN materias ON SUBSTRING(mat.cla,1,6) = SUBSTRING(materias.cla,1,6) WHERE mat.cla != materias.cla"))->get();
            foreach ($inscritos as $inscrito) {
                if ($inscrito->cla == $mate->cla) {
                    $matertomada = true;
                }

            }


            if ($cantPre == $cantPrePasados and $seleccionoMateria and $matertomada)  {
               
                array_push($materias, $mate);
            }


        }
        //var_dump($inscritos);


        //$materias2 = DB::table('materias')->orderBy('materia')->get();
        $materias4 = DB::table(DB::raw("(SELECT * FROM `kardex` where examen is not null and calificacion > 5) kardex INNER JOIN grupos on grupos.id = kardex.id_grupo RIGHT JOIN (SELECT * FROM materias where cla LIKE '%L' )  materias ON
id_materia = materias.id where id_materia is null" ))->orderBy('materia')->get();
        //var_dump($materias);
        $request->user()->authorizeRoles(['admin']);
        $request->user()->hasRole('admin');
        $prom = DB::table('alumnos')->select("prom_ant")->where('id', '=', Auth::user()->id_alumno)->get();
        $fecha = DB::table('fechaseleccion')->where('promedio', '=', $prom[0]->prom_ant)->get();
        $fechaactual=date("Y-m-d H:i:s");

        $bandera=true;

        $fechabase=$fecha[0];

        switch ($prom[0]->prom_ant){
            case 10:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 9:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 8:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 7:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 6:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 5:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;

                }
                break;
            case 4:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 3:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 2:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 1:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case 0:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
            case -1:
                if (strtotime($fechaactual) >= strtotime($fechabase->fechainicio)){
                    $bandera=false;
                }
                break;
        }

        if ($bandera){
            abort(401);
        }

        //$materias = DB::table('materias')->orderBy('materia')->get();

        return view('escogel',compact('materias'));
    }
}
