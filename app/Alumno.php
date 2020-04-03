<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Alumno extends Model
{
    use Notifiable;

    protected $primaryKey = 'socialSecurityNo';

    public $incrementing = false;

}
