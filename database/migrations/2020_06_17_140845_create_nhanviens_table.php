<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNhanviensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanviens', function (Blueprint $table) {
            $table->id();
            $table->string('hoTen',50);
            $table->string('chucVu',30);
            $table->integer('namSinh');
            $table->string('cmnd',30);
            $table->string('diaChi',50);
            $table->string('sdt',11);
            $table->string('anhChanDung',30)->default('default.png');
            $table->boolean('gioiTinh')->default(true);   /// true -- nam    |    false --- nu
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
        Schema::dropIfExists('nhanviens');
    }
}
