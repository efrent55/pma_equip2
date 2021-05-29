<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Profile;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'Administrator')->first();
        $user = new User();
        $user->email = 'administrator@pma.ph';
        $user->username = 'admin';
        $user->password = bcrypt('secret');
        $user->api_token = str_random(60);
        $user->save();
        $profile = new Profile();
        $profile->firstname = 'Efren';
        $profile->middlename = 'L';
        $profile->lastname = 'Tabtab';
        $profile->gender = 'Male';
        $profile->profile_type = 'Admin';
        $user->profiles()->save($profile);
        $user->roles()->attach($role);
    }
}
