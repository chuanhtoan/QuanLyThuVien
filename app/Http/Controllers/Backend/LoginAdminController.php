<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Admin;
use Hash;
use Validator;
use App\Notifications\EmailQuenMatKhau;
use Carbon\Carbon;
class LoginAdminController extends Controller
{
   public function getLogin (){
      

        return view ('backend.login');
   }
   public function postLogin(Request $request){
    $arr = [
      'tenTaiKhoan'=>$request->get('tenTaiKhoan'),
      'password' => $request->get('pass')
    ];

    
      if(Auth::guard('admin')->attempt($arr) ){
        return \redirect(route('sach.index'));
      }else{
         return view ('backend.login')->with(['error'=>true]);
      }
   }
   

   public function getRegister(){
      $nhanviens = \App\Model\nhanvien::all();
      return view ('backend.register')->with(['nhanvien'=>$nhanviens]);
   }

   public function postRegister(Request $request){


      // dd($request);
      $admin = new Admin();
      $admin->tenTaiKhoan = $request->tenTaiKhoan;
      $admin->email = $request->email;
      $admin->password = bcrypt($request->pass);
      $admin->ID_NhanVien = $request->idNhanVien;

      $admin->save();

      Auth::guard('admin')->login($admin);

      
      return \redirect(route('sach.index'));

      // dd($request);
   }

   public function index(){
       dd("Day la trang quan tri");
   }

   public function valid(Request $request){
        
       $validate = Validator::make(
         $request->all(),
         [
            'tenTaiKhoan' => 'unique:admins',
            'email' =>'unique:admins'     
         ],
         [
             'unique'=>':attribute đã tồn tại'
         ],
         [
            'tenTaiKhoan' => 'Tên tài khoản',
            'email' => 'Email'
         ]
       );
       
        return \response()->json([
            'isValid'=>$validate->fails(),
        ],200
        );

   }


   public function viewQuenMatKhau(){
      return view('backend.quenmatkhau');
 }

 
 public function postQuenMK(Request $request){
   
    $admin = \App\Admin::where('tenTaiKhoan',$request->tenTaiKhoan)->first();
    $admin->taoMaXacThuc();
    $admin->notify(new EmailQuenMatKhau($admin));
    $admin->confirm_pass = $request->pass;
    $admin->save();
    return view('backend.xacthucmail')->with(['info'=>'Email đã được gửi, hãy check email để tiếp tục hành trình']);
} 

  public function kttaikhoan($value){
      $tk = \App\Admin::where('tenTaiKhoan',$value)->first();
      if($tk)
        return \response()->json(['yes'=>true],200);
      else
      return \response()->json(['yes'=>false],200);
  }


  public function xacnhan($id,$code){
      $taikhoan = \App\Admin::find($id);
      $t = Carbon::parse($taikhoan->thoiGianGuiMail);
      $now = Carbon::now(); 
      // dd($code .  '   ' . $taikhoan->maXacThuc)
      if($taikhoan->maXacThuc != $code ){
         return view('backend.xacthucmail')->with(
            ['info'=>'Mã xác thực không chính xác']);

      }else if($t->diffInMinutes($now) < 0){
         return view('backend.xacthucmail')->with(
            ['info'=>'Mã xác thực đã hết hiệu lực ']);             
      }else{
             $taikhoan->password = bcrypt( $taikhoan->confirm_pass);
             $taikhoan->save();
            return view('backend.xacthucmail')->with(['info'=>'Đổi mật khẩu thành công']);
         
         }
  }
}