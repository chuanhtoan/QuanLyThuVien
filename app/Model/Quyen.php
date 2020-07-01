<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'quyens';
    protected $fillable = [
        'tenQuyen',
        'maQuyen',
        'id',
        'moTa',
    ];
    public function chucvus(){
        return $this->belongsToMany('App\Model\chucvu','chucvu_quyen','ID_Quyen','ID_ChucVu');
    }

}
