<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed dummy users for testing.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $dikdaRole = Role::where('name', 'operator_dikda')->first();
        $sekolahRole = Role::where('name', 'operator_sekolah')->first();

        User::updateOrCreate(
            ['email' => 'admin@spmb.test'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
                'organization_id' => null,
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'dikda@spmb.test'],
            [
                'name' => 'Operator Dikda',
                'password' => Hash::make('password'),
                'role_id' => $dikdaRole->id,
                'organization_id' => null,
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'sekolah@spmb.test'],
            [
                'name' => 'Operator Sekolah',
                'password' => Hash::make('password'),
                'role_id' => $sekolahRole->id,
                'organization_id' => null, // Can be assigned to a specific school later
                'is_active' => true,
            ]
        );
    }
}
