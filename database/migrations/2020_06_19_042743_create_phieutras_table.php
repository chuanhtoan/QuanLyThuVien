<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;
class CreatePhieutrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieutras', function (Blueprint $table) {
            $table->id();
            $table->dateTime('ngayTra')->default(Carbon::now());
            $table->integer('ID_PhieuMuon');
            $table->integer('ID_NhanVien');
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
        Schema::dropIfExists('phieutras');
    }
}
