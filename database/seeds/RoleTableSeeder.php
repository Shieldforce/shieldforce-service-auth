<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->delete();
        $role1 = Role::create([
            'id'                   =>1,
            'name'                 =>'Administrator',
            'label'                =>'Administrador Master',
            'system'               =>1,
            'group'                =>'Funções do Sistema',
            'institution_id'       =>1
        ]);
        $role2 = Role::create([
            'id'                   =>2,
            'name'                 =>'User',
            'label'                =>'Usuário do Sistema',
            'system'               =>1,
            'group'                =>'Funções do Sistema',
            'institution_id'       =>1
        ]);
    }
}
