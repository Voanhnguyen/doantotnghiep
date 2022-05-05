<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhap', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->dateTime('NgayNhap');
            $table->integer('SoLuong');
            $table->decimal('TongTien', $precision = 8, $scale = 2);
            $table->float('CanNang');
            $table->boolean('TinhTrang');
        });

        Schema::table('nhap', function (Blueprint $table) {
            $table->renameColumn('SoLuong', 'TongSL');
            $table->renameColumn('CanNang', 'TongCanNang');
        });

        
        // Schema::table('nhap', function (Blueprint $table) {
        //     $table->integer('Giong_ID');
        //     $table->foreign('Giong_ID')->references('ID')->on('giong');

        //     $table->integer('Chuong_ID');
        //     $table->foreign('Chuong_ID')->references('ID')->on('chuong');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhap');
    }
}
