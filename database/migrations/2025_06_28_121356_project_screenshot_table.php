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
        Schema::create('project_screenshot', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('project_id')
            ->constrained('projects')
            ->onDelete('cascade');
            $table->string('img')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_screenshot');
    }
};
