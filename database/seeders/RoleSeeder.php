<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Karona Srun', 
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]); 
        $admin->assignRole(['Administrator']);
        
        $user = User::create([
            'name' => 'User Normal', 
            'email' => 'user@gmail.com',
            'password' => Hash::make('password')
        ]);
        $user->assignRole(['User Normal']);
    }
}
