<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tacgia extends Model
{
    protected $table='tacgias';
    protected $fillable = ['id','hoTen','namSinh','namMat','quocTich','tomTat'];
}

