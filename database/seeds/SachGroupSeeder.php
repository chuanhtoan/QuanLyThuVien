<?php

use Illuminate\Database\Seeder;

/*
    Seeder cho các bảng group Sách:
        - NhaXuatBan
        - TacGia
        - TheLoai
        - Sach
        - AnhReview
        - CuonSach
*/

class SachGroupSeeder extends Seeder{

    public function run()
    {  
        $this->call(NhaXuatBansSeeder::class);
        $this->call(TacGiasSeeder::class);
        $this->call(TheLoaisSeeder::class);
        $this->call(SachsSeeder::class);
        $this->call(AnhReviewsSeeder::class);
        $this->call(CuonSachsSeeder::class);
    }
}

class NhaXuatBansSeeder extends Seeder{

    public function run()
    {  
        DB::table('nhaxbs')->insert([
            ['tenNhaXB'=>'Kim Đồng','email'=>(Str::random(5).'@gmail.com'),'sdt'=>rand(1111111111,9999999999)]
        ]);
    }
}

class TacGiasSeeder extends Seeder{

    public function run()
    {  
        DB::table('tacgias')->insert([
            ['hoTen'=>'Nguyễn Du','namSinh'=>rand(1930,1960),'namMat'=>rand(1961,1980),'quocGia'=>'Việt Nam','tomTatNgan'=>'Ông là một nhà thơ lỗi lạc','anhChanDung'=>'Link']
        ]);
    }
}

class TheLoaisSeeder extends Seeder{

    public function run()
    {  
        DB::table('theloais')->insert([
            ['tenTheLoai'=>'Giáo Trình','mieuTa'=>'Giáo trình học tập của sinh viên,học sinh','ID_Cha'=>null],
        ]);
    }
}

class SachsSeeder extends Seeder{

    public function run()
    {  
        DB::table('sachs')->insert([
            ['tenSach'=>'Cuốn theo chiều gió','namXuatBan'=>1990,'anhBia'=>'Link','diemDanhGia'=>5.5,'soLuong'=>30,'gia'=>20000,'mieuTa'=>'Cuốn theo chiều gió','soLuongMuon'=>5,'choPhepMuon'=>true,'ID_TheLoai'=>1,'ID_TacGia'=>1,'ID_NhaXB'=>1]
        ]);
    }
}

class AnhReviewsSeeder extends Seeder{

    public function run()
    {  
        DB::table('anhreviews')->insert([
            ['url'=>'Link','ID_Sach'=>1]
        ]);
    }
}

class CuonSachsSeeder extends Seeder{

    public function run()
    {  
        DB::table('cuonsachs')->insert([
            ['ID_Sach'=>1],
            ['ID_Sach'=>1],
            ['ID_Sach'=>1],
            ['ID_Sach'=>1],
            ['ID_Sach'=>1]
        ]);
    }
}
