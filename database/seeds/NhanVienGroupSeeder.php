<?php

use Illuminate\Database\Seeder;

/*
    Seeder cho các bảng group Nhân Viên:
        - NhanVien
        - PhieuMuon
        - ChiTietPhieuMuon
        - PhieuTra
        - ChiTietPhieuTra
        - PhieuPhat
        - PhieuDat
        - PhieuNhap
        - ChiTietPhieuNhap
*/

class NhanVienGroupSeeder extends Seeder{

    public function run()
    {  
        $this->call(NhanViensSeeder::class);
        $this->call(PhieuMuonsSeeder::class);
        $this->call(ChiTietPhieuMuonsSeeder::class);
        $this->call(PhieuTrasSeeder::class);
        $this->call(ChiTietPhieuTrasSeeder::class);
        // $this->call(PhieuPhatsSeeder::class);
        $this->call(PhieuDatsSeeder::class);
        $this->call(PhieuNhapsSeeder::class);
        $this->call(ChiTietPhieuNhapsSeeder::class);
    }
}

class NhanViensSeeder extends Seeder{

    public function run()
    {  
        DB::table('nhanviens')->insert([
            ['hoTen'=>'Nguyễn Phúc Hoài Linh','chucVu'=>'Nhân viên trực thư viện','namSinh'=>rand(1990,2002),'cmnd'=>rand(1111111111,9999999999),'diaChi'=>'TP.HCM','sdt'=>rand(1111111111,9999999999)]
        ]);
    }
}

class PhieuMuonsSeeder extends Seeder{

    public function run()
    {  
        DB::table('phieumuons')->insert([
            ['ngayMuon'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'ngayHenTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_DocGia'=>1,'ID_NhanVien'=>1,'daTra'=>0,'soLuongSach'=>2],
            ['ngayMuon'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'ngayHenTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_DocGia'=>1,'ID_NhanVien'=>1,'daTra'=>0,'soLuongSach'=>2],
            ['ngayMuon'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'ngayHenTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_DocGia'=>1,'ID_NhanVien'=>1,'daTra'=>0,'soLuongSach'=>2],
            ['ngayMuon'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'ngayHenTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_DocGia'=>1,'ID_NhanVien'=>1,'daTra'=>0,'soLuongSach'=>2],
            ['ngayMuon'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'ngayHenTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_DocGia'=>1,'ID_NhanVien'=>1,'daTra'=>0,'soLuongSach'=>2],
        ]);
    }
}

class ChiTietPhieuMuonsSeeder extends Seeder{

    public function run()
    {  
        DB::table('chitietphieumuons')->insert([
            ['ID_PhieuMuon'=>1,'ID_CuonSach'=>1],
            ['ID_PhieuMuon'=>1,'ID_CuonSach'=>2],
            ['ID_PhieuMuon'=>1,'ID_CuonSach'=>3],
            ['ID_PhieuMuon'=>1,'ID_CuonSach'=>4],
            ['ID_PhieuMuon'=>1,'ID_CuonSach'=>5],

            ['ID_PhieuMuon'=>2,'ID_CuonSach'=>1],
            ['ID_PhieuMuon'=>2,'ID_CuonSach'=>2],
            ['ID_PhieuMuon'=>2,'ID_CuonSach'=>3],
            ['ID_PhieuMuon'=>2,'ID_CuonSach'=>4],
            ['ID_PhieuMuon'=>2,'ID_CuonSach'=>5]
        ]);
    }
}

class PhieuTrasSeeder extends Seeder{

    public function run()
    {  
        DB::table('phieutras')->insert([
            ['ngayTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_PhieuMuon'=>1,'ID_NhanVien'=>1],
            ['ngayTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_PhieuMuon'=>1,'ID_NhanVien'=>1],
            ['ngayTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_PhieuMuon'=>1,'ID_NhanVien'=>1],
            ['ngayTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_PhieuMuon'=>1,'ID_NhanVien'=>1],
            ['ngayTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_PhieuMuon'=>1,'ID_NhanVien'=>1],
            ['ngayTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_PhieuMuon'=>1,'ID_NhanVien'=>1],
            ['ngayTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_PhieuMuon'=>1,'ID_NhanVien'=>1],
            ['ngayTra'=>date("Y-m-d", strtotime( '+'.mt_rand(0,30).' days')),'ID_PhieuMuon'=>1,'ID_NhanVien'=>1]
        ]);
    }
}

class ChiTietPhieuTrasSeeder extends Seeder{

    public function run()
    {  
        DB::table('chitietphieutras')->insert([
            ['ID_PhieuTra'=>1,'ID_CuonSach'=>1],
            ['ID_PhieuTra'=>1,'ID_CuonSach'=>2],
            ['ID_PhieuTra'=>1,'ID_CuonSach'=>3],
            ['ID_PhieuTra'=>1,'ID_CuonSach'=>4],
            ['ID_PhieuTra'=>1,'ID_CuonSach'=>5],
            
            ['ID_PhieuTra'=>2,'ID_CuonSach'=>1],
            ['ID_PhieuTra'=>2,'ID_CuonSach'=>2],
            ['ID_PhieuTra'=>2,'ID_CuonSach'=>3],
            ['ID_PhieuTra'=>2,'ID_CuonSach'=>4],
            ['ID_PhieuTra'=>2,'ID_CuonSach'=>5],
        ]);
    }
}

// class PhieuPhatsSeeder extends Seeder{

//     public function run()
//     {  
//         DB::table('phieuphats')->insert([
//             ['ghiChu'=>'Trả sách trễ','denBu'=>15000,'ID_NhanVien'=>1,'ID_PhieuTra'=>1]
//         ]);
//     }
// }

class PhieuDatsSeeder extends Seeder{

    public function run()
    {  
        DB::table('phieudats')->insert([
            ['ngayLap'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'daSuDung'=>0,'ID_NhanVien'=>1,'ID_DocGia'=>1],
            ['ngayLap'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'daSuDung'=>0,'ID_NhanVien'=>1,'ID_DocGia'=>1],
            ['ngayLap'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'daSuDung'=>0,'ID_NhanVien'=>1,'ID_DocGia'=>1],
            ['ngayLap'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'daSuDung'=>0,'ID_NhanVien'=>1,'ID_DocGia'=>1],
            ['ngayLap'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'daSuDung'=>0,'ID_NhanVien'=>1,'ID_DocGia'=>1],
        ]);
    }
}

class PhieuNhapsSeeder extends Seeder{

    public function run()
    {  
        DB::table('phieunhaps')->insert([
            ['ngayLap'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'gia'=>50000,'ID_NhanVien'=>1,'ID_PhieuYeuCau'=>1,'ID_NhaXB'=>1],
            ['ngayLap'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'gia'=>50000,'ID_NhanVien'=>1,'ID_PhieuYeuCau'=>1,'ID_NhaXB'=>1],
            ['ngayLap'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'gia'=>50000,'ID_NhanVien'=>1,'ID_PhieuYeuCau'=>1,'ID_NhaXB'=>1],
            ['ngayLap'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'gia'=>50000,'ID_NhanVien'=>1,'ID_PhieuYeuCau'=>1,'ID_NhaXB'=>1],
            ['ngayLap'=>date("Y-m-d", strtotime( '+'.mt_rand(31,60).' days')),'gia'=>50000,'ID_NhanVien'=>1,'ID_PhieuYeuCau'=>1,'ID_NhaXB'=>1]
        ]);
    }
}

class ChiTietPhieuNhapsSeeder extends Seeder{

    public function run()
    {  
        DB::table('chitietphieunhaps')->insert([
            ['ID_PhieuNhap'=>1,'ID_CuonSach'=>1],
            ['ID_PhieuNhap'=>1,'ID_CuonSach'=>1],
            ['ID_PhieuNhap'=>1,'ID_CuonSach'=>1],
            ['ID_PhieuNhap'=>1,'ID_CuonSach'=>1],
            ['ID_PhieuNhap'=>1,'ID_CuonSach'=>1]
        ]);
    }
}
