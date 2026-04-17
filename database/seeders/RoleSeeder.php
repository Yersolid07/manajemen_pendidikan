<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the roles table.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Super administrator dengan akses penuh ke seluruh sistem.',
            ],
            [
                'name' => 'operator_dikda',
                'display_name' => 'Operator Dikda',
                'description' => 'Operator Dinas Pendidikan Daerah, dapat melihat data seluruh sekolah.',
            ],
            [
                'name' => 'operator_sekolah',
                'display_name' => 'Operator Sekolah',
                'description' => 'Operator tingkat sekolah, hanya dapat mengelola data sekolah sendiri.',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
