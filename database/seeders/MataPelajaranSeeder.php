<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MataPelajaranSeeder extends Seeder
{
    /**
     * Seed mata pelajaran (subjects) data.
     */
    public function run(): void
    {
        $subjects = [
            ['code' => 'MAT', 'name' => 'Matematika', 'group_name' => 'Matematika', 'education_level' => 'BOTH'],
            ['code' => 'FIS', 'name' => 'Fisika', 'group_name' => 'IPA', 'education_level' => 'SMA'],
            ['code' => 'KIM', 'name' => 'Kimia', 'group_name' => 'IPA', 'education_level' => 'SMA'],
            ['code' => 'BIO', 'name' => 'Biologi', 'group_name' => 'IPA', 'education_level' => 'SMA'],
            ['code' => 'SEJ', 'name' => 'Sejarah', 'group_name' => 'IPS', 'education_level' => 'SMA'],
            ['code' => 'SOS', 'name' => 'Sosiologi', 'group_name' => 'IPS', 'education_level' => 'SMA'],
            ['code' => 'ANT', 'name' => 'Antropologi', 'group_name' => 'IPS', 'education_level' => 'SMA'],
            ['code' => 'EKO', 'name' => 'Ekonomi', 'group_name' => 'IPS', 'education_level' => 'SMA'],
            ['code' => 'GEO', 'name' => 'Geografi', 'group_name' => 'IPS', 'education_level' => 'SMA'],
            ['code' => 'BIN', 'name' => 'Bahasa Indonesia', 'group_name' => 'Bahasa', 'education_level' => 'BOTH'],
            ['code' => 'BIG', 'name' => 'Bahasa Inggris', 'group_name' => 'Bahasa', 'education_level' => 'BOTH'],
            ['code' => 'PKN', 'name' => 'Pendidikan Kewarganegaraan', 'group_name' => 'Umum', 'education_level' => 'BOTH'],
            ['code' => 'PAI', 'name' => 'Pendidikan Agama Islam', 'group_name' => 'Agama', 'education_level' => 'BOTH'],
            ['code' => 'PAK', 'name' => 'Pendidikan Agama Kristen', 'group_name' => 'Agama', 'education_level' => 'BOTH'],
            ['code' => 'PJO', 'name' => 'Pendidikan Jasmani', 'group_name' => 'Umum', 'education_level' => 'BOTH'],
            ['code' => 'SBD', 'name' => 'Seni Budaya', 'group_name' => 'Seni', 'education_level' => 'BOTH'],
            ['code' => 'INF', 'name' => 'Informatika', 'group_name' => 'Teknologi', 'education_level' => 'BOTH'],
            ['code' => 'TKR', 'name' => 'Teknik Kendaraan Ringan', 'group_name' => 'Kejuruan', 'education_level' => 'SMK'],
            ['code' => 'RPL', 'name' => 'Rekayasa Perangkat Lunak', 'group_name' => 'Kejuruan', 'education_level' => 'SMK'],
            ['code' => 'AKT', 'name' => 'Akuntansi', 'group_name' => 'Kejuruan', 'education_level' => 'SMK'],
            ['code' => 'TKJ', 'name' => 'Teknik Komputer dan Jaringan', 'group_name' => 'Kejuruan', 'education_level' => 'SMK'],
            ['code' => 'ADM', 'name' => 'Administrasi Perkantoran', 'group_name' => 'Kejuruan', 'education_level' => 'SMK'],
        ];

        foreach ($subjects as $subject) {
            MataPelajaran::updateOrCreate(['code' => $subject['code']], $subject);
        }
    }
}
