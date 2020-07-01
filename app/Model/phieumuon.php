<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class phieumuon extends Model
{
    protected $table='phieumuons';
    protected $fillable = ['id','ngayMuon','ngayTra','ID_DocGia','ID_NhanVien','daTra','soLuongSach' ];

    public function cuonsachs(){
        return $this->belongsToMany('App\Model\cuonsach','chitietphieumuons','ID_PhieuMuon','ID_CuonSach');
    }

    // public function docgia(){
    //     return $this->belongsTo('App\Model\docgia','ID_DocGia');
    // }

    public function docgia(){
        return $this->hasOne('App\Model\docgia','id','ID_DocGia');
    }

    public function nhanvien(){
        return $this->hasOne('App\Model\nhanvien','id','ID_NhanVien');
    }

}
