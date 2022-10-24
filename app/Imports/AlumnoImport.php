<?php
namespace App\Imports;

use App\Alumno;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\{Importable, ToModel, WithHeadingRow};


class UserImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new User([
            'id_alumno'     => $row['id_alumno'],
            'nombre'    => $row['nombre'],
            'email' => $row['email'],
            'tipo' => $row['tipo'],
            'id_programa_educativo' => $row['id_programa_educativo'],
        ]);
    }

    //SI SE NECESITAN REGLAS SE ESCRTIBEN EN ESTA FUNCION
    public function rules()
    {
        return [
            'registration_number' => 'regex:/[A-Z]{3}-[0-9]{3}/',
            'doors' => 'in:2,4,6',
            'years' => 'between:1998,2017'
        ];
    }
}
