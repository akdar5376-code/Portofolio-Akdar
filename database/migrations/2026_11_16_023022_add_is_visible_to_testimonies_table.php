<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('testimonies', function (Blueprint $table) {
            $table->boolean('is_visible')->default(true)->after('message');
            $table->dropColumn(['origin', 'position', 'photo_path', 'rating']);
        });

        DB::table('testimonies')->where('role', 'guru_pembimbing')->update(['role' => 'guru']);
        DB::table('testimonies')->where('role', 'teman')->update(['role' => 'siswa']);
        DB::table('testimonies')->where('role', 'tempat_plk')->update(['role' => 'tempat_magang']);

        Schema::table('testimonies', function (Blueprint $table) {
            $table->string('role')->default('siswa')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('testimonies', function (Blueprint $table) {
            $table->string('role')->default('guru_pembimbing')->change();
            $table->dropColumn('is_visible');
            $table->string('origin')->nullable();
            $table->string('position')->nullable();
            $table->string('photo_path')->nullable();
            $table->unsignedTinyInteger('rating')->nullable();
        });

        DB::table('testimonies')->where('role', 'guru')->update(['role' => 'guru_pembimbing']);
        DB::table('testimonies')->where('role', 'siswa')->update(['role' => 'teman']);
        DB::table('testimonies')->where('role', 'tempat_magang')->update(['role' => 'tempat_plk']);
    }
};
