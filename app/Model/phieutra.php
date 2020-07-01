<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class phieutra extends Model
{
    protected $table='phieutras';
    protected $fillable = ['id','ngayTra','ID_PhieuMuon','ID_NhanVien'];


    public function phieumuon(){
        return $this->hasOne('App\Model\phieumuon','id','ID_PhieuMuon');
    }
    public function cuonsachs(){
        return $this->belongsToMany('App\Model\cuonsach','chitietphieutras','ID_PhieuTra','ID_CuonSach');
    }

}
