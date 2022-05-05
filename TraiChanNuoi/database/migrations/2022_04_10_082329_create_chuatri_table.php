<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChuatriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuatri', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->dateTime('NgayChuaTri');
            $table->string('LoaiBenh');
            $table->string('LoaiThuoc');
            $table->integer('SoLuong');
            $table->string('GhiChu');
        });


        Schema::table('chuatri', function (Blueprint $table) {
            $table->integer('Chuong_ID');
            $table->foreign('Chuong_ID')->references('ID')->on('chuong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chuatri');
    }
}
