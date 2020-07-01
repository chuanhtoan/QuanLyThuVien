<?php

use Illuminate\Database\Seeder;

/*
    Seeder cho các bảng group Độc Giả:
        - DocGia
        - TheDocGia
        - User
        - ThongBao
*/

/*
    Hàm random ngày trong khoảng hôm nay -> 300 ngày trước
    date("Y-m-d", strtotime( '+'.mt_rand(0,300).' days'))
*/

class DocGiaGroupSeeder extends Seeder{

    public function run()
    {  
        $this->call(DocGiasSeeder::class);
        $this->call(TheDocGiasSeeder::class);
        $this->call(ThongBaosSeeder::class);
    }
}

class DocGiasSeeder extends Seeder{

    public function run()
    {  
        DB::table('docgias')->insert([
            ['hoTen'=>'Chu Anh Toàn','namSinh'=>rand(1990,2002),'diaChi'=>'TP.HCM','sdt'=>rand(1111111111,9999999999),'email'=>Str::random(5).'@gmail.com']
        ]);
    }
}

class TheDocGiasSeeder extends Seeder{

    public function run()
    {  
        DB::table('thedocgias')->insert([
            ['ngayLapThe'=>date("Y-m-d",strtotime( '+'.mt_rand(0,300).' days')),'ID_DocGia'=>1]
        ]);
    }
}

// class UsersSeeder extends Seeder{
// }

class ThongBaosSeeder extends Seeder{

    public function run()
    {  
        DB::table('thongbaos')->insert([
            ['noiDung'=>'Tài khoản của bạn đang có vấn đề về bảo mật','ngayLapThongBao'=>date("Y-m-d",strtotime( '+'.mt_rand(0,300).' days')),'ID_User'=>1]
        ]);
    }
}
