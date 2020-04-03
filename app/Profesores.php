<?php

namespace App;

use App\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Profesores extends Model
{
    use Notifiable;

    protected $fillable = [
        'id', 'nombre', 'apaterno', 'amaterno',
    ];

}
