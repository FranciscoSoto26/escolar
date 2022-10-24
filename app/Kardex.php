<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Alumno extends Model
{
    use Notifiable;

    protected  $table = 'alumnos';

    protected $primaryKey = 'id';
    protected $keyType = 'varchar';
    public $timestamps = false;

    protected $fillable = [
        'id', 'apaterno', 'amaterno', 'nombre','sexo', 'curp','email', 'estado','nuevo_ingreso', 'prom_ant','id_programa_educativo',
    ];

}
