<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
class CreatePhieunhapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieunhaps', function (Blueprint $table) {
            $table->id();
            $table->integer('ID_NhanVien');
            $table->integer('ID_PhieuYeuCau');
            $table->foreignId('ID_NhaXB')->constrained('nhaxbs');
            $table->dateTime('ngayLap')->default(Carbon::now());
            $table->integer('gia');
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
        Schema::dropIfExists('phieunhaps');
    }
}
