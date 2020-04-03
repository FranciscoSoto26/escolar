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


class MateriasController extends Controller
{
    public function materias()
    {
        //$mats = Materias::all();

        //$preres = Prerequisitos::find(1)->materia;

        $materias = DB::table('materias')->orderBy('materia')->get();

        return view('materias',compact('materias'));
    }

    public function more(Materias $materia)
    {

        $preres = DB::table('prerequisitos')->leftJoin('materias', 'prerequisitos.id_prerequisito', '=', 'materias.id')->where('prerequisitos.id_materia', '=', $materia->id)->get();
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



        //print_r($horas);
        /*print_r($horas);
        foreach ($grups as $grup){
            $hora[]=DB::table('grupos')->select('id')->where('id_materia', '=', $grup->id_materia, 'and', 'id_profesor', '=', $grup->id_profesor)->get();
        }*/

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

        //$inscritos= DB::table('inscritos')->where('id_grupo','=',$grups[0]->id_supergrupo)->count();

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
        return view('more',compact('materia','preres','grups','horas','capacidad','materias'));//,'inscritos'));
    }



    /*
    public function add(Request $request, User $user, Material $material)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'materials' =>'required',
            'quantity' =>'required'

        ]);
        $material->user_id=$request->id;
        $material->materials = $request->materials;
        $material->quantity = $request->quantity;

        $material->save();

        return redirect()->route('users.materials',$request->id);
    }

    public function admat(User $user)
    {
        return view('users.admat',['user' => $user]);
        //return view('users.imagen',compact('user'));
    }

    public function destroy(Material $material)
    {

        $material->delete();
        return redirect()->route('users.index');


    }
    */



    public function mismaterias(Request $request)
    {
        $request->user();

        $mihorarios = DB::table('inscritos')->where('id_alumno', '=', Auth::user()->id_alumno)->get();
        $nmaterias = DB::table(DB::raw("(SELECT * From (SELECT * FROM `inscritos` WHERE id_alumno = '". Auth::user()->id_alumno."') as inscritos LEFT JOIN grupos on inscritos.id_grupo = grupos.id) as grupos "
        ))
            ->leftJoin("materias", "grupos.id_materia", "=", "materias.id")
            ->addSelect(["*"])
            ->get();
        $nhoras = DB::table(DB::raw("(SELECT grupos.id,grupos.id_grupo, grupos.id_alumno, grupos.id_supergrupo, grupos.id_ciclo, grupos.id_materia, grupos.id_profesor, grupos.id_sinodal, materias.cla, materias.materia,materias.horas,materias.creditos,materias.carrera,materias.tipo,materias.tiene_laboratorio,materias.grado,materias.id_academia,materias.clave_ce,materias.precreditos From (SELECT * FROM (SELECT * FROM `inscritos` WHERE id_alumno = '". Auth::user()->id_alumno."') as inscritos LEFT JOIN grupos on inscritos.id_grupo = grupos.id) as grupos left join materias on grupos.id_materia = materias.id) as grupitos"
        ))
            ->leftJoin("horarios", "grupitos.id", "=", "horarios.id_grupo")
            ->addSelect(["*"])->orderBy('entrada')
            ->get();
        $nprofesor = DB::table(DB::raw("(SELECT * From (SELECT * FROM `inscritos` WHERE id_alumno = '". Auth::user()->id_alumno."') as inscritos LEFT JOIN grupos on inscritos.id_grupo = grupos.id) as grupos "
        ))->leftJoin("profesores", "grupos.id_profesor", "=", "profesores.id")->addSelect(["nombre","apaterno","amaterno" ,"email"])->get();

        foreach ($nhoras as $nhora) {
            $horaInicio = new DateTime($nhora->entrada);
            $horaTermino = new DateTime($nhora->salida);
            $interval = $horaInicio->diff($horaTermino);
            $nhora->tiempo = (int)$interval->format('%H');
        }



        $i=0;
        foreach ($nmaterias as $nmateria){
            $mhoras = array("materia" => $nmateria->materia,"nprofesor" => $nprofesor[$i]->nombre." ".$nprofesor[$i]->apaterno." ".$nprofesor[$i]->amaterno,"creditos"=> $nmateria->creditos,"carrera"=> $nmateria->carrera);
            $mihoras[] = $mhoras;

            $i++;
        }

        function sabeh($h){
            switch ($h){
                case 0:
                    return "07:00:00";
                case 1:
                    return "08:00:00";
                case 2:
                    return "09:00:00";
                case 3:
                    return "10:00:00";
                case 4:
                    return "11:00:00";
                case 5:
                    return "12:00:00";
                case 6:
                    return "13:00:00";
                case 7:
                    return "14:00:00";
                case 8:
                    return "15:00:00";
                case 9:
                    return "16:00:00";
                case 10:
                    return "17:00:00";
                case 11:
                    return "18:00:00";
                case 12:
                    return "19:00:00";
                case 13:
                    return "20:00:00";
                case 14:
                    return "21:00:00";
            }

        }
        function dia($n){
            switch ($n){
                case 1:
                    return "LUNES";
                case 2:
                    return "MARTES";
                case 3:
                    return "MIERCOLES";
                case 4:
                    return "JUEVES";
                case 5:
                    return "VIERNES";
            }
        }


        function ceros(){
            for ($i=1;$i<6;$i++){
                for ($j=0;$j<14;$j++) {
                    $mih[$i][$j]="-";
                }
            }
            return $mih;
        }

        function hora($horas){
            $mih = ceros();
            for ($i=1;$i<6;$i++){
                foreach ($horas as $hora){
                    $eldia=dia($i);
                    if($eldia == $hora->dia){
                        for ($j=0;$j<14;$j++){
                            $lahora=sabeh($j);
                            if ($lahora == $hora->entrada){
                                $mih[$i][$j]=$hora->materia." - ".$hora->id_espacio;
                                for ($k=0;$k<$hora->tiempo;$k++){
                                    $mih[$i][$j+$k]=$hora->materia." - ".$hora->id_espacio;
                                }
                            }

                        }

                    }
                }

            }
            return $mih;
        }


        $mih=hora($nhoras);

        /*for ($h=1; $h<5; $h++){
            if(dia($h) = $nhoras->id_dia){

            }
        }
        $newhorario = array();
        foreach ($nhoras as $nhora){

        }*/


        return view('mismate',compact('mihorarios','nmaterias','nhoras','nprofesor','mihoras','mih'));
    }
    public function mishoras(Request $request)
    {
        $request->user();

        $mihorarios = DB::table('inscritos')->where('id_alumno', '=', Auth::user()->id_alumno)->get();
        $nmaterias = DB::table(DB::raw("(SELECT * From (SELECT * FROM `inscritos` WHERE id_alumno = '". Auth::user()->id_alumno."') as inscritos LEFT JOIN grupos on inscritos.id_grupo = grupos.id) as grupos "
        ))
            ->leftJoin("materias", "grupos.id_materia", "=", "materias.id")
            ->addSelect(["*"])
            ->get();
        $nhoras = DB::table(DB::raw("(SELECT grupos.id,grupos.id_grupo, grupos.id_alumno, grupos.id_supergrupo, grupos.id_ciclo, grupos.id_materia, grupos.id_profesor, grupos.id_sinodal, materias.cla, materias.materia,materias.horas,materias.creditos,materias.carrera,materias.tipo,materias.tiene_laboratorio,materias.grado,materias.id_academia,materias.clave_ce,materias.precreditos From (SELECT * FROM (SELECT * FROM `inscritos` WHERE id_alumno = '". Auth::user()->id_alumno."') as inscritos LEFT JOIN grupos on inscritos.id_grupo = grupos.id) as grupos left join materias on grupos.id_materia = materias.id) as grupitos"
        ))
            ->leftJoin("horarios", "grupitos.id", "=", "horarios.id_grupo")
            ->addSelect(["*"])->orderBy('entrada')
            ->get();
        $nprofesor = DB::table(DB::raw("(SELECT * From (SELECT * FROM `inscritos` WHERE id_alumno = '". Auth::user()->id_alumno."') as inscritos LEFT JOIN grupos on inscritos.id_grupo = grupos.id) as grupos "
        ))->leftJoin("profesores", "grupos.id_profesor", "=", "profesores.id")->addSelect(["nombre","apaterno","amaterno" ,"email"])->get();

        foreach ($nhoras as $nhora) {
            $horaInicio = new DateTime($nhora->entrada);
            $horaTermino = new DateTime($nhora->salida);
            $interval = $horaInicio->diff($horaTermino);
            $nhora->tiempo = (int)$interval->format('%H');
        }



        $i=0;
        foreach ($nmaterias as $nmateria){
            $mhoras = array("materia" => $nmateria->materia,"nprofesor" => $nprofesor[$i]->nombre." ".$nprofesor[$i]->apaterno." ".$nprofesor[$i]->amaterno,"creditos"=> $nmateria->creditos,"carrera"=> $nmateria->carrera, "grupo"=> $nmateria->id_grupo);
            $mihoras[] = $mhoras;

            $i++;
        }



        return view('mishoras',compact('mihoras','nmaterias'));
    }
}
