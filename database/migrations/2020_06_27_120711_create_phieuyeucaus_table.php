<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
class CreatePhieuyeucausTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieuyeucaus', function (Blueprint $table) {
            $table->id();
            $table->integer('ID_NhanVien');
            $table->integer('ID_NhaXB');
            $table->dateTime('ngayDat')->default(Carbon::now());
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
        Schema::dropIfExists('phieuyeucaus');
    }
}
