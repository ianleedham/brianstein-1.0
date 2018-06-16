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
        $role_user =new  Role();
        $role_user -> name = 'User';
        $role_user -> description = 'a normal user';
        $role_user -> save();

        $role_author =new  Role();
        $role_author -> name = 'Author';
        $role_author -> description = 'a writer/author';
        $role_author -> save();

        $role_admin =new  Role();
        $role_admin -> name = 'Admin';
        $role_admin -> description = 'administrator';
        $role_admin -> save();
    }
}
