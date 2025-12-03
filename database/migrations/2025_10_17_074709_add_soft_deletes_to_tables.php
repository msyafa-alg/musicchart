<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add soft deletes to artists
        if (!Schema::hasColumn('artists', 'deleted_at')) {
            Schema::table('artists', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        // Add soft deletes to albums
        if (!Schema::hasColumn('albums', 'deleted_at')) {
            Schema::table('albums', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        // Add soft deletes to songs
        if (!Schema::hasColumn('songs', 'deleted_at')) {
            Schema::table('songs', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('albums', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('songs', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
