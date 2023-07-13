<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alatbarangs', function (Blueprint $table) {
            $table->string('slug', 255)->nullable()->after('nama');
            $table->string('cover', 255)->nullable()->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alatbarangs', function (Blueprint $table) {
            if (Schema::hasColumn('alatbarangs', 'slug')) {
                $table->dropColumn('slug');
            }

            if (Schema::hasColumn('alatbarangs', 'cover')) {
                $table->dropColumn('cover');
            }
        });
    }
};
