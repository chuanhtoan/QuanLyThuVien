<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Chitietphieuyeucau extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietphieuyeucaus', function (Blueprint $table) {
            $table->id();
            $table->integer('ID_Sach');
            $table->foreignId('ID_PhieuYeuCau')->constrained('phieuyeucaus')->onDelete('cascade');
            $table->integer('soLuong');
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
        Schema::dropIfExists('chitietphieuyeucaus');
    }
}
