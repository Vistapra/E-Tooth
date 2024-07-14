<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menjalankan seeder RolePermissionSeeder untuk membuat peran
        $this->call(RolePermissionSeeder::class);

        // Mendapatkan peran 'owner' dari database
        $ownerRole = Role::where('name', 'owner')->first();

        // Membuat user baru sebagai owner
        $userOwner = User::create([
            'name' => 'E-Tooth',
            'email' => 'e-tooth@owner.com',
            'password' => Hash::make('e-tooth')
        ]);

        // Menugaskan peran 'owner' kepada user
        $userOwner->assignRole($ownerRole);
    }
}
