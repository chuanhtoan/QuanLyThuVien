<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BienBanViPham extends Controller
{
    public function __construct(){
        $this->middleware('KiemTraQuyen:quan_ly_bien_ban',['except'=>['index'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang = \App\Model\bienbanvipham::paginate(5);
        
        for($i = 0 ;$i<count($mang);$i++){
           
            $ngay = $mang[$i]->ngayLap;
            $mang[$i]->ngayLap = Carbon::parse($ngay);

        }
        return view ('backend.pages.bienbanvipham.index',['page'=>1,'arr'=>$mang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nhanvien = \App\Model\nhanvien::all();
        return view ('backend.pages.bienbanvipham.create',['nhanvien'=>$nhanvien]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vipham = new \App\Model\bienbanvipham();
        $vipham->ID_PhieuMuon = $request->ID_PhieuMuon;
        $vipham->ID_NhanVien = $request->ID_NhanVien;
        $vipham->ngayLap = $request->ngayLap;
        $vipham->noiDung = $request->noiDung;
        $vipham->tienPhat = $request->tienPhat;
        $vipham->save();
        return  \response()->json(['yes'=>true],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
        $nhanvien = \App\Model\nhanvien::all();
        $vipham = \App\Model\bienbanvipham::find($id)->first();
        return view('backend.pages.bienbanvipham.edit')->with(['nhanvien'=>$nhanvien,'vipham'=>$vipham]);
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
        $vipham = \App\Model\bienbanvipham::find($id);
        $vipham->ID_PhieuMuon = $request->ID_PhieuMuon;
        $vipham->ID_NhanVien = $request->ID_NhanVien;
        $vipham->ngayLap = $request->ngayLap;
        $vipham->noiDung = $request->noiDung;
        $vipham->tienPhat = $request->tienPhat;
        $vipham->save();
        return  \response()->json(['yes'=>true],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Model\bienbanvipham::destroy($id);
        return \response()->json(['size'=>\App\Model\bienbanvipham::count()],200);
    }




    public function pagination(Request $request){

        if($request->ajax()){
            $mang = \App\Model\bienbanvipham::paginate(5);
            for($i = 0 ;$i<count($mang);$i++){
           
                $ngay = $mang[$i]->ngayLap;
                $mang[$i]->ngayLap = Carbon::parse($ngay);
    
            }
            return  
            view ('backend.pages.bienbanvipham.phantrang',['page'=>$request->page,'arr'=>$mang])->render();
        }
    }

}
