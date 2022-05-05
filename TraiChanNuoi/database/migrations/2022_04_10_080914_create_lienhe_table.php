<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLienheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lienhe', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('HoTen');
            $table->string('Email');
            $table->string('NoiDung');
            $table->string('TieuDe');
            $table->string('SDT');
            $table->dateTime('NgayLH');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lienhe');
    }
}
