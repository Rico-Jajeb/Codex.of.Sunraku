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
        Schema::create('codex', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codex_name');
            $table->string('language');
            $table->string('framework');
            $table->string('tags');
            $table->string('diffuclt_level');
            $table->string('content');
            $table->longText('code_snippet');
            $table->string('instructions');
            $table->string('output');
            $table->string('img');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codex');
    }
};
