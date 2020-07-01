<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class chucvu extends Model
{
    protected $table = 'chucvus';
    protected $fillable = [
        'tenChucVu',
        'id',
    ];
    public function quyens(){
        return $this->belongsToMany('App\Model\Quyen','chucvu_quyen','ID_ChucVu','ID_Quyen');
    }
}
