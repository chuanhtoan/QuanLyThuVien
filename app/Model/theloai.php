<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class theloai extends Model
{
    protected $table='theloais';
    protected $fillable = ['id','tenTheLoai','mieuTa','ID_Cha','soLuongNode'];
}
