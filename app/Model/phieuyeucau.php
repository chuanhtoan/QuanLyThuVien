<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class phieuyeucau extends Model
{
    protected $table = 'phieuyeucaus';
    protected $fillable = ['id','ID_NhanVien','ID_NhaXB','ngayDat'];

    public function nhaXB(){
        return $this->hasOne('App\Model\nhaxb','id','ID_NhaXB');
    }

    public function nhanvien(){
        return $this->hasOne('App\Model\nhanvien','id','ID_NhanVien');
    }

    public function sach(){
        return $this->belongsToMany('App\Model\sach','chitietphieuyeucaus','ID_PhieuYeuCau','ID_Sach');
    }
}
