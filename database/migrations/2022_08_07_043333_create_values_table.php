<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('values', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->nullable();
            $table->integer('class_id')->nullable();
            $table->integer('subject_code')->nullable();
            $table->date('date')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('values');
    }
};
