<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('subject_id');
            $table->integer('level');
            $table->text('question');
            $table->text('true_answer');
            $table->text('false_answer');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
