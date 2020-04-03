<?php

namespace App\Http\Controllers;

use App\Grupos;
use App\Inscritos;
use DateTime;
use Illuminate\Http\Request;
use App\User;
use App\Materias;
use App\Prerequisitos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class SeleccionController extends Controller
{

    public function elige(Materias $materia, Request $request)
    {

        $preres = DB::table('prerequisitos')->leftJoin('materias', 'prerequisitos.id_prerequisito', '=', 'materias.cla')->where('prerequisitos.id_materia', '=', $materia->cla)->get();
        $profs = DB::table('grupos')->select('id_profesor')->where('id_materia', '=', $materia->id)->get();
        //print_r($profs[0]);


        $grups = DB::table(DB::raw("(SELECT * FROM grupos where id_materia ='" . $materia->id . "' )
                    as id_profs "))->leftJoin("profesores", "id_profs.id_profesor", "=", "profesores.id")->addSelect(["*","id_profs.id"])->get();
        $query = "(SELECT * FROM grupos where ";
        foreach ($grups as $grup){
            $query2 = " id_materia = '".$grup->id_materia."' and  id_profesor = '".$grup->id_profesor."' ";
            $query = $query.$query2." OR";
        }
        $query = substr($query,0,-2).")";

        $horasf = DB::table(DB::raw($query." as grupo "))->leftJoin("horarios", "grupo.id", "=", "horarios.id_grupo")->addSelect(["grupo.id_supergrupo","id_espacio","dia","entrada","salida"])->get();


        $queryss="";
        foreach ($horasf as $hora) {
            $queryss = $queryss.' id= "'.$hora->id_espacio.'" OR';
        }


        $queryf = substr($queryss,0,-2);


        $capacidad = DB::table("espacios")->whereRaw($queryf)->get();

        foreach ($grups as $grup) {
            $ho = [];
            foreach ($horasf as $hora) {
                if ($hora->id_supergrupo == $grup->id_supergrupo) {
                    $ho[] = $hora;
                }
            }

            $horas[]=$ho;
        }

        if(isset($horas)){
            foreach ($horas as $hora) {
                $horaAnt=null;
                foreach ($hora as $ho) {

                    foreach ($capacidad as $cap) {
                        if ($ho->id_espacio == $cap->id) {
                            if(isset($horaAnt) && $horaAnt->capacidad > $cap->capacidad) {
                                $ho->capacidad = $cap->capacidad;
                                $horaAnt->capacidad= $cap->capacidad;
                            }else{
                                if(isset($horaAnt))
                                    $ho->capacidad = $horaAnt->capacidad;
                                else
                                    $ho->capacidad = $cap->capacidad;
                            }

                        }

                    }
                    $horaAnt = $ho;
                }
            }
        }
        else{
            $horas=NULL;
        }


        $materias = DB::table('materias')->orderBy('materia')->get();


        $query = "(SELECT COUNT(*) as inscritos_count , id_grupo,id_alumno FROM inscritos where ";
        foreach ($grups as $grup){
            $query2 = " id_grupo = '".$grup->id."' ";
            $query = $query.$query2." OR";
        }
        $query = substr($query,0,-2)." GROUP BY id_grupo,id_alumno)";
        $inscs = DB::table(DB::raw($query." as inscritos "))
            ->leftJoin("grupos", "inscritos.id_grupo", "=", "grupos.id")
            ->addSelect(["inscritos_count","id_supergrupo"])
            ->get();

        foreach ($grups as $grup) {
            $grup->inscritos_count = 0;
            foreach ($inscs as $insc) {
                if ($insc->id_supergrupo == $grup->id_supergrupo) {
                    $grup->inscritos_count = $insc->inscritos_count;
                }
            }
        }


        //""'profesores','grupos.id_profesor','=','profesores.id')->where('grupos.id_profesor','=' ,'profesores.id')->get();
        return view('elige',compact('materia','preres','grups','horas','capacidad','materias'));//,'inscritos'));
    }

    public function pre(Request $request)
    {
        $request = request();
        $grupo = $request->all();



    DB::table('inscritos')->insert(
            ['id_alumno' => Auth::user()->id_alumno, 'id_grupo' => $grupo["grupo"]]
        );

        return redirect()->route('escogem')
            ->with('success','Materia Seleccionada');
    }

    public function baja(Request $request)
    {
        $request = request();
        $grupo = $request->all();

        print_r($grupo);
        DB::table('inscritos')
            ->where(['id_alumno' => Auth::user()->id_alumno, 'id_grupo' => $grupo["grupo"]])
            ->delete();

        return redirect()->route('mishoras')
            ->with('success','Materia Seleccionada');
    }

    public function estatus(Request $request)
    {
        $request->user();

        $estatus = DB::table('alumnos')
            ->select('estado')
            ->where('id', '=', Auth::user()->id_alumno)
            ->get();

        if ($estatus= "ART_34" or "BAJA"){
            abort(401);
        }




    }
}
