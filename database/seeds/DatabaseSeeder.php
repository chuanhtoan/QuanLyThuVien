<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Admin;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsSeeder::class);
        // $this->call(UsersSeeder::class);
        // $this->call(NhanVienSeeder::class);
        // $this->call(QuyensSeeder::class);
        // $this->call(ChucVuSeeder::class);
        // $this->call(PhanQuyenSeeder::class);
        // $this->call(Admin_Chucvu::class);
        // $this->call(DocGiasSeeder::class);

        // $this->call(SachGroupSeeder::class);
        // $this->call(NhanVienGroupSeeder::class);
    }
}
class UsersSeeder extends Seeder{

    public function run()
    {
        DB::table('users')->insert(
            [
                'tenTaiKhoan'=>'user',
                'password'=>bcrypt('user'),
                'email'=>'khongnhoemail33@gmail.com',
                'ID_DocGia'=>'1',
            ]
        );
    }
}

class AdminsSeeder extends Seeder{

    public function run()
    {  
        $admin = new Admin();
        $admin->tenTaiKhoan = 'admin';
        $admin->email = 'khongnhoemail33@gmail.com';
        $admin->password = bcrypt('admin');
        $admin->ID_NhanVien = 1;
        $admin->save();
      
    }
}

class NhanVienSeeder extends Seeder{

    public function run()
    {  
        DB::table('nhanviens')->insert([
            ['hoTen'=>'Nguyễn Phúc Hoài Linh','chucVu'=>'Nhân viên thường','namSinh'=>1999,'cmnd'=>rand(1111111111,9999999999),'diaChi'=>'TP.HCM','sdt'=>rand(1111111111,9999999999),
            ]
        ]);
    }
}

class QuyensSeeder extends Seeder{

    public function run()
    {  
        DB::table('quyens')->insert([

            ['tenQuyen'=>'Quản lý Sách','maQuyen'=>'quan_ly_sach','moTa'=>'Quyền quản lý Sách'],
           
            ['tenQuyen'=>'Quản lý Phiếu mượn','maQuyen'=>'quan_ly_phieu_muon','moTa'=>'Quyền quản lý Phiếu mượn'],
           
            ['tenQuyen'=>'Quản lý Phiếu trả','maQuyen'=>'quan_ly_phieu_tra','moTa'=>'Quyền quản lý Phiếu trả'],
           
            ['tenQuyen'=>'Quản lý Phiếu đặt','maQuyen'=>'quan_ly_phieu_dat','moTa'=>'Quyền quản lý Phiếu đặt'],
           
            ['tenQuyen'=>'Quản lý Biên bản','maQuyen'=>'quan_ly_bien_ban','moTa'=>'Quyền quản lý Biên bản'],
           
            ['tenQuyen'=>'Quản lý Độc giả','maQuyen'=>'quan_ly_doc_gia','moTa'=>'Quyền quản lý Độc giả'],
           
            ['tenQuyen'=>'Quản lý Phiếu yêu cầu','maQuyen'=>'quan_ly_phieu_yeu_cau','moTa'=>'Quyền quản lý Phiếu yêu cầu'],
           
            ['tenQuyen'=>'Quản lý Phiếu nhập','maQuyen'=>'quan_ly_phieu_nhap','moTa'=>'Quyền quản lý Phiếu nhập'],
           
            ['tenQuyen'=>'Viết review','maQuyen'=>'viet_review','moTa'=>'Quyền viết review'],
           
            ['tenQuyen'=>'Quản lý Tài khoản','maQuyen'=>'quan_ly_tai_khoan','moTa'=>'Quyền quản lý Tài khoản'],
           
            ['tenQuyen'=>'ALL','maQuyen'=>'ALL','moTa'=>'Bao gồm tất cả các quyền'],
           
            ]);
      
    }
}



class ChucVuSeeder extends Seeder
{
    public function run()
    {
        DB::table('chucvus')->insert([
             ['tenChucVu'=>'Quản lý'],       // 1
             ['tenChucVu'=>'Nhân viên'],     // 2
             ['tenChucVu'=>'Nhân viên viết bài'], // 3
             ['tenChucVu'=>'Nhân viên nhập liệu'], //4 
             
        ]);
    }

}

class PhanQuyenSeeder extends Seeder
{
    public function run()
    {
        DB::table('chucvu_quyen')->insert([
            ['ID_ChucVu'=>3,'ID_Quyen'=>1],
            ['ID_ChucVu'=>3,'ID_Quyen'=>9],


            ['ID_ChucVu'=>4,'ID_Quyen'=>1],
            ['ID_ChucVu'=>4,'ID_Quyen'=>7],
            ['ID_ChucVu'=>4,'ID_Quyen'=>8],

            ['ID_ChucVu'=>2,'ID_Quyen'=>1],
            ['ID_ChucVu'=>2,'ID_Quyen'=>2],
            ['ID_ChucVu'=>2,'ID_Quyen'=>3],
            ['ID_ChucVu'=>2,'ID_Quyen'=>4],
            ['ID_ChucVu'=>2,'ID_Quyen'=>5],
            ['ID_ChucVu'=>2,'ID_Quyen'=>6],

            ['ID_ChucVu'=>1,'ID_Quyen'=>11],
        
            
        ]);
    }

}



class Admin_Chucvu extends Seeder
{
    public function run()
    {
        DB::table('admin_chucvu')->insert([
             ['ID_Admin'=>1,'ID_ChucVu'=>1],       // 1
             
            
             
        ]);
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


