<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add popularity to artists
        Schema::table('artists', function (Blueprint $table) {
            $table->integer('popularity')->default(0)->after('photo');
        });

        // Add popularity to songs
        Schema::table('songs', function (Blueprint $table) {
            $table->integer('popularity')->default(0)->after('durasi');
        });

        // Add popularity to albums
        Schema::table('albums', function (Blueprint $table) {
            $table->integer('popularity')->default(0)->after('cover');
        });
    }

    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropColumn('popularity');
        });

        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('popularity');
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->dropColumn('popularity');
        });
    }
};
