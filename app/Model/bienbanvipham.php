<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class bienbanvipham extends Model
{
    protected $table = 'bienbanviphams';
    protected $fillable = ['id','ID_PhieuMuon','ID_NhanVien','ngayLap','noiDung','tienPhat'];


    public function phieumuon(){
        return $this->belongsTo('App\Model\phieumuon','ID_PhieuMuon');
    }

    public function nhanvien(){
        return $this->belongsTo('App\Model\nhanvien','ID_NhanVien');
    }

}
