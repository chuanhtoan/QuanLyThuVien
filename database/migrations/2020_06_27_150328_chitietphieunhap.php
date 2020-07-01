<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Chitietphieunhap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietphieunhaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_PhieuNhap')->constrained('phieunhaps')->onDelete('cascade');
            $table->foreignId('ID_CuonSach')->constrained('cuonsachs')->onDelete('cascade');
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
        Schema::dropIfExists('chitietphieunhaps');

    }
}
