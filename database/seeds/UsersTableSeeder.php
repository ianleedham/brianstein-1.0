<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'User')->first();
        $role_author = Role::where('name', 'Author')->first();
        $user_admin = User::where('name', 'brian')->first();
        $user_author = User::where('name', 'Izzybell')->first();

        $user_admin ->roles()->attach($role_admin);
        $user_author ->roles()->attach($role_author);
    }
}
