<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class sach extends Model
{
    protected $table='saches';
    protected $fillable = ['id','tenSach','ID_TacGia','ID_TheLoai','ID_NXB',
    'mieuTa','soLuong','gia','anhBia','namXB','diemDanhGia','duocPhepMuon','vietTat'];    
      
}
