<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test/{data}',function($data){
  return \view('test')->with(['html'=>$data]);
})->name('test');

Route::group(
   ['prefix'=>'admin', 'namespace'=>'Backend'],
   function(){
       Route::get('/','LoginAdminController@getLogin')->name('admin.login');
       Route::post('/postLogin','LoginAdminController@postLogin')->name('admin.postLogin');
       Route::post('/postRegister','LoginAdminController@postRegister')->name('admin.postRegister');
       Route::get('/quenMK','LoginAdminController@viewQuenMatKhau')->name('admin.quenMK');
       Route::get('/kttaikhoan/{value}','LoginAdminController@kttaikhoan')->name('admin.kttaikhoan');
       Route::get('/xacnhan/{id}/code/{code}','LoginAdminController@xacnhan')->name('admin.xacnhan');
       Route::post('/postQuenMK','LoginAdminController@postQuenMK')->name('admin.postQuenMK');


      //  Route::get('/register','LoginAdminController@getRegister')->name('admin.register');
       Route::post('/valid','LoginAdminController@valid')->name('admin.validAdmin');
       
       Route::group(['prefix'=>'danhmuc','middleware'=>'authadmin'], function(){
             Route::get('/list','LoginAdminController@index')->name('admin.index');
            

             Route::group(['prefix'=>'theloai'],function(){
                 Route::get('phantrang','TheLoai@pagination')->name('theloai-chuyen');
               }
            );
             Route::group(['prefix'=>'tacgia'],function(){
                Route::get('phantrang','TacGia@pagination')->name('tacgia-chuyen');
              }
            );
            Route::group(['prefix'=>'nxb'],function(){
              Route::get('phantrang','NXB@pagination')->name('nxb-chuyen');}
            );
           
            Route::group(['prefix'=>'docgia'],function(){
              Route::get('phantrang','DocGia@pagination')->name('docgia-chuyen');}
            );
            Route::group(['prefix'=>'nhanvien'],function(){
              Route::get('phantrang','NhanVien@pagination')->name('nhanvien-chuyen');}
            );
           
            Route::group(['prefix'=>'sach'],function(){
              Route::get('phantrang','Sach@pagination')->name('sach-chuyen');
              Route::get('review/{id}','Sach@review')->name('sach.review')->middleware('KiemTraQuyen:soan_bai');
              Route::post('write/{id}','Sach@write')->name('sach.write');
              Route::get('search','Sach@search')->name('sach.search');
              Route::get('loc','Sach@formLoc')->name('sach.loc-dialog');
              Route::get('lockq','Sach@locDanhSach')->name('sach.loc-kq');
            
            }
            );
            Route::group(['prefix'=>'taikhoan'],function(){
              Route::post('avatar/{id}','TaiKhoan@thayDoiAnhDaiDien')->name('taikhoan.avatar');
              Route::get('nhanvien/{id}','TaiKhoan@nhanvien')->name('taikhoan.nhanvien');
              Route::get('laychucvu/{id}','TaiKhoan@get_admin_chuc_vu')->name('taikhoan.layChucVu');
              Route::post('insert-admin/{id_admin}/chucvu/{id_chuvu}','TaiKhoan@insert_admin_chucvu')->name('taikhoan.insert.admin-chucvu');
              Route::delete('admin/{id_admin}/chucvu/{id_chucvu}','TaiKhoan@destroy_admin_chucvu')->name('taikhoan.destroy.admin-chucvu');
              Route::get('doimatkhau/{id}/code/{code}','TaiKhoan@getViewDoiMatKhau')->name('taikhoan.doimatkhau_'); 
              Route::post('doimatkhau/{id}','TaiKhoan@doiMatKhau')->name('taikhoan.doimatkhau'); 
              Route::get('email/{id}','TaiKhoan@guiEmailDoiMatKhau')->name('taikhoan.mail'); 
              Route::get('logout','TaiKhoan@logout')->name('taikhoan.logout');
            }
            );

            Route::group(['prefix'=>'chucvu'],function(){
              Route::get('phantrang','ChucVu@pagination')->name('chucvu-chuyen');}
            );
            Route::group(['prefix'=>'phieumuon'],function(){
              Route::post('them_chitiet/{id}','PhieuMuon@them_chitiet')->name('cuonsach.add');
              Route::get('phantrang','PhieuMuon@pagination')->name('cuonsach.pagination');
              Route::get('kttontai/{id}','PhieuMuon@kiemTraTonTai')->name('cuonsach.tontai');
              Route::get('review/{id}','PhieuMuon@review')->name('phieumuon.review');
              Route::get('new_review','PhieuMuon@new_review')->name('phieumuon.new_review');

            });
            Route::group(['prefix'=>'vipham'],function(){
              Route::get('phantrang','BienBanViPham@pagination')->name('vipham.pagination');
            
            });
            Route::group(['prefix'=>'phieuyeucau'],function(){
              Route::get('phantrang','PhieuYeuCau@pagination')->name('phieuyeucau.pagination');
              Route::get('get_nhaXB_sach','PhieuYeuCau@get_nhaXB_sach')->name('phieuyeucau.get_nhaXB_sach');
              Route::post('them_chitiet/{id}','PhieuYeuCau@them_chitiet')->name('phieuyeucau.them_chitiet');
              Route::get('kttontai/{id}','PhieuYeuCau@kttontai')->name('phieuyeucau.kttontai');

            });

            Route::group(['prefix'=>'phieutra'],function(){
              Route::post('them_chitiet/{id}','PhieuTra@them_chitiet')->name('phieutra.add');
              Route::get('phantrang','PhieuTra@pagination')->name('phieutra.pagination');
              Route::post('ktvipham','PhieuTra@kiemTraViPham')->name('phieutra.ktvipham');
            });
            Route::group(['prefix'=>'phieunhap'],function(){
              Route::get('phantrang','PhieuNhap@pagination')->name('phieunhap.pagination');
              Route::get('get_nhaXB_sach','PhieuNhap@get_nhaXB_sach')->name('phieunhap.get_nhaXB_sach');
              Route::post('them_chitiet/{id}','PhieuNhap@them_chitiet')->name('phieunhap.them_chitiet');
            
            });

            Route::group(['prefix'=>'phieudat'],function(){
              Route::post('them_chitiet/{id}','PhieuDat@them_chitiet')->name('cuonsach.add');
              Route::get('phantrang','PhieuDat@pagination')->name('cuonsach.pagination');
            });

            Route::resource('sach','Sach');
            Route::resource('theloai','TheLoai');
            Route::resource('nxb','NXB');
           
            Route::resource('tacgia','TacGia');
            Route::resource('docgia','DocGia');
            Route::resource('nhanvien','NhanVien');
            Route::resource('taikhoan','TaiKhoan');
            Route::resource('phieumuon','PhieuMuon');
            Route::resource('phieutra','PhieuTra');
            Route::resource('chucvu','ChucVu');
            Route::resource('vipham','BienBanViPham');
            Route::resource('phieuyeucau','PhieuYeuCau');
            Route::resource('phieunhap','PhieuNhap');
            Route::resource('phieudat','PhieuDat');
            
        }
    );
   }
);



