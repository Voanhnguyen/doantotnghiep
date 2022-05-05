<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCtNhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ct_nhap', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->integer('Giong_ID');
            $table->integer('Chuong_ID');
            $table->integer('Nhap_ID');
            $table->integer('SoLuong');
            $table->decimal('DonGia', $precision = 8, $scale = 2);
            $table->decimal('Tong', $precision = 8, $scale = 2);
            $table->float('CanNang');
        });

        Schema::table('ct_nhap', function (Blueprint $table) {
            $table->foreign('Giong_ID')->references('ID')->on('giong');
            $table->foreign('Chuong_ID')->references('ID')->on('chuong');
            $table->foreign('Nhap_ID')->references('ID')->on('nhap');
        });

        Schema::table('nhap', function (Blueprint $table) {
            $table->renameColumn('SoLuong', 'TongSL');
            $table->renameColumn('CanNang', 'TongCanNang');

            $table->dropForeign(['Chuong_ID']);
            $table->dropForeign(['Giong_ID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ct_nhap');
    }
}
