<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FromView;

class AlumnosExport implements FromView

{

    use Exportable;

    public function view(): View
    {
        return view('exports.alumnos',[
            'users' => User::all()
        ]);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
}
