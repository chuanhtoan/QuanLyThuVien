<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class chitietphieutra extends Model
{
    protected $table='chitietphieutras';
    protected $fillable = ['ID_PhieuTra','ID_CuonSach'];
}
