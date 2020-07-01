<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;
class CreatePhieumuonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieumuons', function (Blueprint $table) {
            $table->id();
            $table->dateTime('ngayMuon')->default(Carbon::now());
            $table->dateTime('ngayHenTra')->default(Carbon::now());
            $table->integer('ID_DocGia');
            $table->integer('ID_NhanVien');
            $table->boolean('daTra');
            $table->integer('soLuongSach');
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
        Schema::dropIfExists('phieumuons');
    }
}
