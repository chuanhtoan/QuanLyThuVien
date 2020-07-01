<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('tenTaiKhoan',50)->unique();
            $table->string('email',50)->unique();
            $table->string('password');
            $table->string('confirm_pass')->nullable();
            $table->string('maXacThuc')->nullable();
            $table->dateTime('thoiGianGuiMail')->nullable();
            $table->date('ngayLap')->default(Carbon::now());
            $table->string('avatar',50)->default('blank.png');
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
        Schema::dropIfExists('admins');
    }
}
