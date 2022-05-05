<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhanvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('TaiKhoan');
            $table->string('MatKhau');
            $table->string('HoTen');
            $table->string('GioiTinh');
            $table->string('Email');
            $table->string('SDT');
            $table->string('DiaChi');
            $table->boolean('Status');
            
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('nhanvien', function (Blueprint $table) {
            $table->integer('Quyen_ID');
            $table->foreign('Quyen_ID')->references('ID')->on('quyen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhanvien');
    }
}
