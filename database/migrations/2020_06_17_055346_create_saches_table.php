<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saches', function (Blueprint $table) {
            $table->id();
            $table->string('tenSach');
            $table->integer('ID_TacGia');
            $table->integer('ID_NXB');
            $table->integer('ID_TheLoai');
            $table->integer('soLuong')->default(0);
            $table->integer('gia')->default(0);
            $table->string('anhBia')->default('default.png');
            $table->integer('namXB');
            $table->double('diemDanhGia')->default(0.0);
            $table->text('mieuTa')->nullable();
            $table->string('vietTat')->unique();
            $table->boolean('duocPhepMuon')->default(true);
             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saches');
    }
}
