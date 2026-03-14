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
        Schema::create('domains_grade_lvls', function (Blueprint $table) {
            $table->foreignId('domains_id')->constrained('domains')->onDelete('cascade');
            $table->foreignId('grade_lvls_id')->constrained('grade_lvls')->onDelete('cascade');
            $table->primary(['domains_id','grade_lvls_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_grade_lvl');
    }
};
