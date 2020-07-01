<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class NhanVien extends Controller
{

    public function __construct(){
        $this->middleware('KiemTraQuyen:ALL',['except'=>['index','show'] ]);
    }

    protected $duongDanAnhDaiDien = "img/avatar/nhanvien";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang =  DB::table('nhanviens')->paginate(5);
        

        return \view('backend.pages.nhanvien.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('backend.pages.nhanvien.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nhanvien = new \App\Model\nhanvien();
        $nhanvien->hoTen = $request->hoTen;
        $nhanvien->chucVu = $request->chucVu;
        $nhanvien->namSinh = $request->namSinh;
        $nhanvien->cmnd = $request->cmnd;
        $nhanvien->diaChi = $request->diaChi;
        $nhanvien->sdt = $request->sdt;
        $nhanvien->gioiTinh = $request->gioiTinh;
        $anhDD = $request->file('anhDaiDien');
        if($anhDD){
            $tenanh = $anhDD->getClientOriginalName();

            $tenanh_ = explode('.',$tenanh)[0];
            $_tenanh = explode('.',$tenanh)[1];
            $tenanh = $tenanh_ .rand(0,100).".".$_tenanh;
            
            $anhDD->move($this->duongDanAnhDaiDien,$tenanh);
            $nhanvien->anhDaiDien = $tenanh;
            $nhanvien->save();
        }else{
        $nhanvien->save();}
        return \response()->json(
            [
                'yes'=>true],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $nhanvien=\App\Model\nhanvien::find($id);
        return view('backend.pages.nhanvien.show',['item'=>$nhanvien]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nhanvien =  \App\Model\nhanvien::find($id);
        return view('backend.pages.nhanvien.edit')->with(['item'=>$nhanvien]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $nhanvien =  \App\Model\nhanvien::find($id);
        $nhanvien->hoTen = $request->hoTen;
        $nhanvien->chucVu = $request->chucVu;
        $nhanvien->namSinh = $request->namSinh;
        $nhanvien->cmnd = $request->cmnd;
        $nhanvien->diaChi = $request->diaChi;
        $nhanvien->sdt = $request->sdt;
        $nhanvien->gioiTinh = $request->gioiTinh;
        $anhDD = $request->file('anhDaiDien');

        if($anhDD && $request->anhDaiDien != "" && $request->anhDaiDien != $nhanvien->anhDaiDien){
            if(File::exists('img/bia/'.$sach->anhBia) && $nhanvien->anhDaiDien != "default.png")
                File::delete('img/bia/'.$sach->anhBia);
            $tenanh = $anhDD->getClientOriginalName();

            $tenanh_ = explode('.',$tenanh)[0];
            $_tenanh = explode('.',$tenanh)[1];
            $tenanh = $tenanh_ .rand(0,100).".".$_tenanh;
            
            $anhDD->move($this->duongDanAnhDaiDien,$tenanh);
            $nhanvien->anhDaiDien = $tenanh;
            $nhanvien->save();
        }else{
        $nhanvien->save();}
        
       return \response()->json(['yes'=>true],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Model\nhanvien::destroy($id);
        return \response()->json(['size'=>\App\Model\nhanvien::count()],200);
    }




    /////


    function pagination(Request $request){
        if($request->ajax()){
            
            $mang =  DB::table('nhanviens')->paginate(5);
           
          return  
          view('backend.pages.nhanvien.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }
}
