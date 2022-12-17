<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('taskexams', function (Blueprint $table) {
            $table->id();
            $table->integer('subject_id');
            $table->integer('class_id');
            $table->string('question_id');
            $table->string('duration')->nullable();
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('taskexams');
    }
};
