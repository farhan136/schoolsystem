<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('religion');
            $table->string('marital_status');
            $table->string('photo')->nullable();
            $table->string('gender');
            $table->integer('place_of_birth');
            $table->date('date_of_birth');
            $table->text('address');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
