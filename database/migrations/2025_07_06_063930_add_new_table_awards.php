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
            Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('award_title');
            $table->text('award_description');
            $table->string('issuer')->nullable();
            $table->string('Date')->nullable();
            $table->string('award_url')->nullable();
            $table->string('highlight')->nullable();
            $table->string('img')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awards');
    }
};
