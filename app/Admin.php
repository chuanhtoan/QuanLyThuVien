<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $guard = 'admin';
    protected $table = 'admins';
    protected $fillable = [
        'tenTaiKhoan',
        'password',
        'id',
        'email',
        'ngayLap',
        'avatar',
        'ID_NhanVien',
        'thoiGianGuiMail',
        'maXacThuc',
        'confirm_pass'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function routeNotificationForMail(){
        return $this->email;
    }

    public function taoMaXacThuc(){
        $this->maXacThuc = \rand(10000,99999);
        $this->thoiGianGuiMail = Carbon::now()->addMinutes(10);
        $this->save();
    }

    public function hoanThanhMa(){
        $this->maXacThuc = "";
        $this->thoiGianGuiMail = "";
        $this->save();
    }



    public function nhanvien(){
        return $this->belongsTo('App\Model\nhanvien','ID_NhanVien');
    }

    public function chucvus(){
        return $this->belongsToMany('App\Model\chucvu','admin_chucvu','ID_Admin','ID_ChucVu'); 
    }

   
}
