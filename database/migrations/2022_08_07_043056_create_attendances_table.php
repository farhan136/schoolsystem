<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->nullable();
            $table->date('date')->nullable();
            $table->enum('is_present', ['Hadir', 'Tidak Hadir'])->nullable();
            $table->enum('description', ['Tepat Waktu', 'Terlambat', 'Izin', 'Tanpa Keterangan', 'Sakit', 'Izin Setengah Hari'])->nullable();
            $table->string('reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
