<?php
namespace App\Imports;

use App\Alumno;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class AlumnosImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new Alumno([
            'INGRESO'     => $row[0],
            'CVEPROG'    => $row[1],
            'PROGRAMA' => $row[2],
            'MATRICULA' => $row[3],
            'APATERNO' => $row[4],
            'AMATERNO' => $row[5],
            'NOMBRE' => $row[6]

        ]);
    }
}
