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
            Schema::table('project_screenshot', function (Blueprint $table) {
            // Drop the existing foreign key first (if needed)
            $table->dropForeign(['project_id']);

            // Then make column nullable
            $table->unsignedBigInteger('project_id')->nullable()->change();

            // Re-add the foreign key constraint
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_screenshot', function (Blueprint $table) {
            // Drop the foreign key
            $table->dropForeign(['project_id']);

            // Make column not nullable again
            $table->unsignedBigInteger('project_id')->nullable(false)->change();

            // Re-add the foreign key
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');
        });
    }
};
