<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
class CreateBienbanviphamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienbanviphams', function (Blueprint $table) {
            $table->id();
            // $table->integer('ID_PhieuMuon');
            $table->foreignId('ID_PhieuMuon')->constrained('phieumuons')->onDelete('cascade');
            $table->integer('ID_NhanVien');
            $table->date('ngayLap')->default(Carbon::now());
            $table->text('noiDung');
            $table->integer('tienPhat')->default(0);
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
        Schema::dropIfExists('bienbanviphams');
    }
}
