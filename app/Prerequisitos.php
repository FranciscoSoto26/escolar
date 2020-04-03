<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Prerequisitos extends Model
{
    use Notifiable;

    protected $table ='prerequisitos';


    public function materia(){
        return $this->hasMany('App\Materias','id', 'id_prerequisito');
        //print_r($this->hasMany('App\Materias','id', 'id_prerequisito'));
    }
}


