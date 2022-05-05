<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtXuatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ct_xuat', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->integer('SoLuong');
            $table->decimal('TongTien', $precision = 8, $scale = 2);
            $table->decimal('DongGia', $precision = 8, $scale = 2);
            $table->float('TongCanNang');
        });


        Schema::table('ct_xuat', function (Blueprint $table) {
            $table->integer('Xuat_ID');
            $table->foreign('Xuat_ID')->references('ID')->on('xuat');

            $table->integer('Chuong_ID');
            $table->foreign('Chuong_ID')->references('ID')->on('chuong');

            $table->integer('Giong_ID');
            $table->foreign('Giong_ID')->references('ID')->on('giong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ct_xuat');
    }
}
