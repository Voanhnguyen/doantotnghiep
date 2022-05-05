<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTintucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tintuc', function (Blueprint $table) {
            $table->integer('ID')->autoIncrement();
            $table->string('TieuDe');
            $table->string('Metatitle');
            $table->string('Anh');
            $table->text('NoiDung');
            $table->dateTime('NgayDang');
            $table->boolean('TrangThai');

            $table->integer('LoaiTin_ID');
            $table->foreign('LoaiTin_ID')->references('ID')->on('loaitin');

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
        Schema::dropIfExists('tintuc');
    }
}
