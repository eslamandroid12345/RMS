<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LaratrustSeeder::class,
            TeamsSeeder::class
        ]);
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => "123123123",
            'phone_number' => '01010100005',
        ]);
        $user = User::create([
            'name' => 'mohamed',
            'email' => 'mohamed@user.com',
            'password' => "123123123",
            'phone_number' => '010123123',
        ]);

        $admin->addRole("super_admin");
        $user->addRole("user");
    }


}
