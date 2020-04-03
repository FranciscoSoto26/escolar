<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Materias;
use App\Prerequisitos;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use PharIo\Version\PreReleaseSuffix;

class SemestreController extends Controller
{
    public function ciclo()
    {

        return view('semestre');
    }

    public function neww(Request $request)
    {
        $data = DB::table('ciclos')->select('id')->where('estado','=','PROXIMO')->get();

        if($data =! '') {

            $cicl = request()->validate([

                'ciclo' => 'required|min:9',
            ]);

            DB::table('ciclos')->insert(
                ['ciclo' => $cicl]
            );

            return view('/home');
        }
        else

        return view('/home');
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
}
