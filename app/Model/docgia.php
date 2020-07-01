<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class docgia extends Model
{
    protected $table='docgias';
    protected $fillable = ['id','hoTen','namSinh','diaChi','sdt','email'];


    public function phieumuons(){
        return $this->hasMany('App\Model\phieumuon','ID_DocGia','id');
    }

    public function phieudats(){
        return $this->hasMany('App\Model\phieudat','ID_DocGia','id');
    }
}
