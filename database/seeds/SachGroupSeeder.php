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
        $this->call(CuonSachsSeeder::class);
    }
}

class NhaXuatBansSeeder extends Seeder{

    public function run()
    {  
        DB::table('nhaxbs')->insert([
            ['tenNXB'=>'Kim Đồng','email'=>(Str::random(5).'@gmail.com'),'sdt'=>rand(1111111111,9999999999)]
        ]);
    }
}

class TacGiasSeeder extends Seeder{

    public function run()
    {  
        DB::table('tacgias')->insert([
            ['hoTen'=>'Nguyễn Du','namSinh'=>rand(1930,1960),'namMat'=>rand(1961,1980),'quocTich'=>'Việt Nam','tomTat'=>'Ông là một nhà thơ lỗi lạc']
        ]);
    }
}

class TheLoaisSeeder extends Seeder{

    public function run()
    {  
        DB::table('theloais')->insert([
            ['tenTheLoai'=>'Giáo Trình','mieuTa'=>'Giáo trình học tập của sinh viên,học sinh','ID_Cha'=>0],
        ]);
    }
}

class SachsSeeder extends Seeder{

    public function run()
    {  
        DB::table('saches')->insert([
            ['tenSach'=>'Cuốn theo chiều gió 1','namXB'=>1990,'anhBia'=>'Link','diemDanhGia'=>5.5,'soLuong'=>30,'gia'=>20000,'mieuTa'=>'Cuốn theo chiều gió','soLuong'=>5,'duocPhepMuon'=>true,'ID_TheLoai'=>1,'ID_TacGia'=>1,'ID_NXB'=>1,'vietTat'=>'CTCG1'],
            ['tenSach'=>'Cuốn theo chiều gió 2','namXB'=>1990,'anhBia'=>'Link','diemDanhGia'=>5.5,'soLuong'=>30,'gia'=>20000,'mieuTa'=>'Cuốn theo chiều gió','soLuong'=>5,'duocPhepMuon'=>true,'ID_TheLoai'=>1,'ID_TacGia'=>1,'ID_NXB'=>1,'vietTat'=>'CTCG2'],
            ['tenSach'=>'Cuốn theo chiều gió 3','namXB'=>1990,'anhBia'=>'Link','diemDanhGia'=>5.5,'soLuong'=>30,'gia'=>20000,'mieuTa'=>'Cuốn theo chiều gió','soLuong'=>5,'duocPhepMuon'=>true,'ID_TheLoai'=>1,'ID_TacGia'=>1,'ID_NXB'=>1,'vietTat'=>'CTCG3'],
            ['tenSach'=>'Cuốn theo chiều gió 4','namXB'=>1990,'anhBia'=>'Link','diemDanhGia'=>5.5,'soLuong'=>30,'gia'=>20000,'mieuTa'=>'Cuốn theo chiều gió','soLuong'=>5,'duocPhepMuon'=>true,'ID_TheLoai'=>1,'ID_TacGia'=>1,'ID_NXB'=>1,'vietTat'=>'CTCG4'],
            ['tenSach'=>'Cuốn theo chiều gió 5','namXB'=>1990,'anhBia'=>'Link','diemDanhGia'=>5.5,'soLuong'=>30,'gia'=>20000,'mieuTa'=>'Cuốn theo chiều gió','soLuong'=>5,'duocPhepMuon'=>true,'ID_TheLoai'=>1,'ID_TacGia'=>1,'ID_NXB'=>1,'vietTat'=>'CTCG5'],
        ]);
    }
}

class CuonSachsSeeder extends Seeder{

    public function run()
    {  
        DB::table('cuonsachs')->insert([
            ['ID_Sach'=>1,'daMuon'=>0,'hienThi'=>'1'],
            ['ID_Sach'=>2,'daMuon'=>0,'hienThi'=>'2'],
            ['ID_Sach'=>3,'daMuon'=>0,'hienThi'=>'3'],
            ['ID_Sach'=>4,'daMuon'=>0,'hienThi'=>'4'],
            ['ID_Sach'=>5,'daMuon'=>0,'hienThi'=>'5'],
            
            ['ID_Sach'=>1,'daMuon'=>0,'hienThi'=>'6'],
            ['ID_Sach'=>2,'daMuon'=>0,'hienThi'=>'7'],
            ['ID_Sach'=>3,'daMuon'=>0,'hienThi'=>'8'],
            ['ID_Sach'=>4,'daMuon'=>0,'hienThi'=>'9'],
            ['ID_Sach'=>5,'daMuon'=>0,'hienThi'=>'10'],
        ]);
    }
}
