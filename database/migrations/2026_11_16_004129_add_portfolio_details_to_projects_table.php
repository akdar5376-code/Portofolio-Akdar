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
        Schema::table('projects', function (Blueprint $table) {
            $table->text('detail')->nullable();
            $table->text('problem')->nullable();
            $table->text('goal')->nullable();
            $table->string('tech_stack')->nullable();
            $table->string('role')->nullable();
            $table->text('features')->nullable();
            $table->string('github_url')->nullable();
            $table->text('process')->nullable();
            $table->text('user_feedback')->nullable();
            $table->boolean('is_featured')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'detail',
                'problem',
                'goal',
                'tech_stack',
                'role',
                'features',
                'github_url',
                'process',
                'user_feedback',
                'is_featured',
            ]);
        });
    }
};
