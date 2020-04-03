<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Materias extends Model
{
    use Notifiable;

    protected $table ='materias';

    protected $primaryKey = 'cla';
    public $incrementing = false;

    protected $fillable = [
        'cla', 'materia',
    ];

}


