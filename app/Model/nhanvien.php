<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class nhanvien extends Model
{
    protected $table='nhanviens';
    protected $fillable = ['id','hoTen','chucVu','namSinh','cmnd','diaChi','sdt'];


    public function admins(){
          return $this->hasMany('\App\Admin','ID_NhanVien');
    }

    // public function 
}
