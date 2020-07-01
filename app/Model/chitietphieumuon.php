<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class chitietphieumuon extends Model
{
    protected $table='chitietphieumuons';
    protected $fillable = ['ID_PhieuMuon','ID_CuonSach'];


    public function cuonsachs(){
        return $this->hasOne('App\Model\cuonsach','ID_CuonSach');
    }
}
