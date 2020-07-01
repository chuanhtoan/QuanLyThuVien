<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class nhaxb extends Model
{
    protected $table='nhaxbs';
    protected $fillable = ['id','tenNXB','email','sdt'];


    public function sachs(){
        return $this->hasMany('App\Model\sach','ID_NXB','id');
    }
}
