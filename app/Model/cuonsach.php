<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cuonsach extends Model
{
    protected $table = 'cuonsachs';
    protected $fillable = ['id','ID_Sach','daMuon','hienThi'];

    public function sach(){
        return $this->hasOne('App\Model\sach','id','ID_Sach');
    }
}
