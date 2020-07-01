<?php

use Illuminate\Database\Seeder;
use App\Model\chucvu;
class ChucVuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        chucvu::create(
           ['tenChucVu'=>'quản lý']    
        );
    }
}
