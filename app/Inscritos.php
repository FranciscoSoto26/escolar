<?php

namespace App;

use App\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Inscritos extends Model
{
    use Notifiable;

    protected $fillable = [
        'id_alumno', 'id_grupo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */




}
