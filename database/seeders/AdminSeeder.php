<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pehle roles create karo agar nahi hain
        $roles = ['admin', 'manager', 'salesperson'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'admin']);
        }

        // Admin
        $admin = Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // Manager
        $manager = Admin::create([
            'name' => 'Sales Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
        ]);
        $manager->assignRole('manager');

        // Salesperson
        $sales = Admin::create([
            'name' => 'Sales Executive',
            'email' => 'sales@example.com',
            'password' => Hash::make('password'),
        ]);
        $sales->assignRole('salesperson');
    }

}
