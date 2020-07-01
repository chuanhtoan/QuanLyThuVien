<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocgiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docgias', function (Blueprint $table) {
            $table->id();
            $table->string('hoTen',50);
            $table->integer('namSinh');
            $table->string('diaChi',50);
            $table->string('sdt',11);
            $table->string('email',40);
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
        Schema::dropIfExists('docgias');
    }
}
