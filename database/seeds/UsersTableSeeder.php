<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'vezeteknev' => 'Admin',
            'keresztnev' => 'Janos',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'telefonszam' => '06301234567',
            'iranyitoszam' => '1234',
            'telepules' => 'Bag',
            'utca' => 'Szőlő utca',
            'hazszam' => '20',
        ]);

        $user = User::create([
            'vezeteknev' => 'User',
            'keresztnev' => 'Bela',
            'email' => 'user@user.com',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
    }
}
