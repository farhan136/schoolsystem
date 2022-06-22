<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schoolclasses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('teacher_id'); //foreign key untuk table employees
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schoolclasses');
    }
};
