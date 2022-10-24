<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Grupos extends Model
{
    protected  $table = 'grupos';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id', 'id_supergrupo', 'id_ciclo', 'id_materia', 'id_profesor', 'id_sinodal'
    ];

    public function materia()
    {
        return $this->hasOne('App\Materias', 'id','id_materia');
    }
    public function profesor()
    {
        return $this->hasOne('App\Profesores', 'id', 'id_profesor');
    }



}


