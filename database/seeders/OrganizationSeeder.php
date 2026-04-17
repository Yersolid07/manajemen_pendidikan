<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Import organizations from the SQL dump file.
     * The dump file is located at c:\Users\jerem\Downloads\dikda\Dump20260415.sql
     */
    public function run(): void
    {
        $dumpFile = 'c:\\Users\\jerem\\Downloads\\dikda\\Dump20260415.sql';

        if (!file_exists($dumpFile)) {
            $this->command->warn("SQL dump file not found at: {$dumpFile}");
            $this->command->warn("Skipping organization import. Please place the dump file and re-run.");
            return;
        }

        $this->command->info("Importing organizations from SQL dump...");

        // Read the SQL dump and extract only INSERT statements for organizations
        $sql = file_get_contents($dumpFile);

        // Extract INSERT statements
        preg_match_all('/INSERT INTO `organizations`[^;]+;/s', $sql, $matches);

        if (empty($matches[0])) {
            $this->command->warn("No INSERT statements found for organizations table.");
            return;
        }

        // Disable FK checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($matches[0] as $insertStatement) {
            DB::unprepared($insertStatement);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $count = DB::table('organizations')->count();
        $this->command->info("Successfully imported {$count} organizations.");
    }
}
