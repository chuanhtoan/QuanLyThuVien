<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class phieudat extends Model
{
   protected $table = 'phieudats';
   protected $fillable = ['id','daSuDung','ngayLap','ID_DocGia','ID_NhanVien'];

   public function docgia(){
       return $this->hasOne('App\Model\docgia','id','ID_DocGia');
   }   

   public function nhanvien(){
      return $this->hasOne('App\Model\nhanvien','id','ID_NhanVien');
   }

   public function cuonsachs(){
      return $this->belongsToMany('App\Model\cuonsach','chitietphieudats','ID_PhieuDat','ID_CuonSach');
   }

}
