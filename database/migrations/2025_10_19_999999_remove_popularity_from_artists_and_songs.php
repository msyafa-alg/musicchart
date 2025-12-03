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
        Schema::table('artists', function (Blueprint $table) {
            if (Schema::hasColumn('artists', 'popularity')) {
                $table->dropColumn('popularity');
            }
        });

        Schema::table('songs', function (Blueprint $table) {
            if (Schema::hasColumn('songs', 'popularity')) {
                $table->dropColumn('popularity');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artists', function (Blueprint $table) {
            if (!Schema::hasColumn('artists', 'popularity')) {
                $table->integer('popularity')->default(0)->after('photo');
            }
        });

        Schema::table('songs', function (Blueprint $table) {
            if (!Schema::hasColumn('songs', 'popularity')) {
                $table->integer('popularity')->default(0)->after('durasi');
            }
        });
    }
};
