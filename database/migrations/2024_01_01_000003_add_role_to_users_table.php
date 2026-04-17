<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->after('password')->constrained('roles')->restrictOnDelete();
            $table->char('organization_id', 36)->nullable()->after('role_id');
            $table->boolean('is_active')->default(true)->after('organization_id');

            $table->foreign('organization_id')->references('organization_id')->on('organizations')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id', 'organization_id', 'is_active']);
        });
    }
};
