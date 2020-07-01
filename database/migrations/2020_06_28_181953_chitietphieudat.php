<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Chitietphieudat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietphieudats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_PhieuDat')->constrained('docgias')->onDelete('cascade');
            $table->integer('ID_CuonSach');
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
        Schema::dropIfExists('chitietphieudats');
    }
}
