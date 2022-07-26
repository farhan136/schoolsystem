<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('parents', function (Blueprint $table) {
            $table->integer('province')->nullable();
            $table->integer('city')->nullable();
            $table->integer('district')->nullable();
            $table->integer('subdistrict')->nullable();
        });
    }

    public function down()
    {
        Schema::table('parents', function (Blueprint $table) {
            //
        });
    }
};
