<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class phieunhap extends Model
{
    protected $table = 'phieunhaps';
    protected $fillable = ['id','ID_NhanVien','ID_NhaXB','ID_PhieuYeuCau','gia','ngayLap'];


    public function phieuyeucau(){
        return $this->hasOne('App\Model\phieuyeucau','id','ID_PhieuYeuCau');
    }
    public function nhaxb(){
        return $this->hasOne('App\Model\nhaxb','id','ID_NhaXB');
    }
    public function nhanvien(){
        return $this->hasOne('App\Model\nhanvien','id','ID_NhanVien');
    }
}
