<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        $user0 = User::create([
            'first_name'           =>'Admin',
            'last_name'            =>'do Sistema',
            'email'                =>'admin@admin',
            'password'             =>bcrypt('cnsa@020459'),
            'system'               => 1,
            'institution_id'       => 1
        ]);
        $user0->roles()->sync([1]);

        $user1 = User::create([
            'first_name'           =>'User',
            'last_name'            =>'do Sistema',
            'email'                =>'user@user',
            'password'             =>bcrypt('user'),
            'system'               => 1,
            'institution_id'       => 1
        ]);
        $user1->roles()->sync([2]);
    }
}

