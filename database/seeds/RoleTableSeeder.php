<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();

        $role = new Role();
        $role->name = 'alumno';
        $role->description = 'Alumno';
        $role->save();

        $role = new Role();
        $role->name = 'director';
        $role->description = 'Director';
        $role->save();

        $role = new Role();
        $role->name = 'profesor';
        $role->description = 'Profesor';
        $role->save();

        $role = new Role();
        $role->name = 'subdirector';
        $role->description = 'Subdirector';
        $role->save();

        $role = new Role();
        $role->name = 'coordinadorcar';
        $role->description = 'CordinadordeCarrera';
        $role->save();$role = new Role();

        $role->name = 'coordinadoraca';
        $role->description = 'CordinadordeAcademia';
        $role->save();

        $role = new Role();
        $role->name = 'laboratorista';
        $role->description = 'Laboratorista';
        $role->save();

        $role = new Role();
        $role->name = 'informes';
        $role->description = 'Informes';
        $role->save();

        $role = new Role();
        $role->name = 'secac';
        $role->description = 'SecretarioAcademico';
        $role->save();

        $role = new Role();
        $role->name = 'secadm';
        $role->description = 'SecretarioAdmnistrativo';
        $role->save();
    }
}
