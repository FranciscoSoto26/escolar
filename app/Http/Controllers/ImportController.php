<?php

namespace App\Http\Controllers;

use App\Imports\AlumnosImport;
use Illuminate\Http\Request;
use App\Alumno;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import()
    {
        Excel::import(new AlumnosImport, 'alumnos.xlsx');

        return redirect('/')->with('success', 'All good!');
    }
}
