<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('albums', 'cover')) {
            Schema::table('albums', function (Blueprint $table) {
                $table->string('cover')->nullable()->after('tanggal_rilis');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('albums', 'cover')) {
            Schema::table('albums', function (Blueprint $table) {
                $table->dropColumn('cover');
            });
        }
    }
};
