<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXuatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xuat', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('TenNguoiMua');
            $table->string('SDT');
            $table->string('LoaiNguoiMua');
            $table->dateTime('NgayXuat');
            $table->integer('TongSL');
            $table->decimal('TongTien', $precision = 8, $scale = 2);
            $table->float('TongCanNang');
            $table->boolean('TinhTrang');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xuat');
    }
}
