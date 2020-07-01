<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cuonsach extends Model
{
    protected $table = 'cuonsachs';
    protected $fillable = ['id','ID_Sach','daMuon','hienThi'];

    public function sach(){
        return $this->belongsTo('App\Model\sach','ID_Sach');
    }
}
