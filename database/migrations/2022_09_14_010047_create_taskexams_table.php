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
        Schema::create('taskexams', function (Blueprint $table) {
            $table->id();
            $table->integer('subject_id');
            $table->integer('class_id');
            $table->string('question_id');
            $table->string('duration');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taskexams');
    }
};
