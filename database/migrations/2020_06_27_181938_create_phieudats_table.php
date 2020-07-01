<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
class CreatePhieudatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieudats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_DocGia')->constrained('docgias')->onDelete('cascade');
            $table->integer('ID_NhanVien');
            $table->dateTime('ngayLap')->default(Carbon::now());
            $table->boolean('daSuDung')->default(false);
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
        Schema::dropIfExists('phieudats');
    }
}
