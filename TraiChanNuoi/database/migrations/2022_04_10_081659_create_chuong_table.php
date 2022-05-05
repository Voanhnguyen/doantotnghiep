<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChuongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuong', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('MaChuong');
            $table->integer('SoLuong');
            $table->dateTime('NgayNhap');
        });

        Schema::table('chuong', function (Blueprint $table) {
            $table->integer('NhanVien_ID');
            $table->foreign('NhanVien_ID')->references('ID')->on('nhanvien');

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chuong');
    }
}
