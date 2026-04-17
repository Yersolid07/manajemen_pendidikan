<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Structure matches the existing Dapodik SQL dump.
     */
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->char('organization_id', 36)->primary();
            $table->string('name', 245);
            $table->char('npsn', 8);
            $table->string('education_type', 20); // SMA, SMK, SMP, SD, TK, etc.
            $table->string('status_school', 50);  // NEGERI, SWASTA
            $table->double('latitude')->default(0);
            $table->double('longitude')->default(0);
            $table->string('province_code', 10)->nullable();
            $table->string('province_name', 255)->nullable();
            $table->string('regency_code', 10)->nullable();
            $table->string('regency_name', 255)->nullable();
            $table->string('district_code', 10)->nullable();
            $table->string('district_name', 255)->nullable();
            $table->string('village_code', 10)->nullable();
            $table->string('village_name', 255)->nullable();
            $table->string('street_name', 255)->nullable();
            $table->text('administrative_area')->nullable();
            $table->tinyInteger('is_school')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_lock')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
