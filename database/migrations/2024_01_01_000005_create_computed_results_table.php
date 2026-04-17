<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Future-ready skeleton for caching computation results (Python/external service).
     */
    public function up(): void
    {
        Schema::create('computed_results', function (Blueprint $table) {
            $table->id();
            $table->string('computation_type', 100); // e.g. "teacher_gap_analysis"
            $table->string('reference_id', 100)->nullable(); // org_id or batch reference
            $table->json('result_data'); // computed data
            $table->timestamp('computed_at');
            $table->boolean('is_stale')->default(false); // flag for re-trigger
            $table->timestamps();

            $table->index(['computation_type', 'reference_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('computed_results');
    }
};
