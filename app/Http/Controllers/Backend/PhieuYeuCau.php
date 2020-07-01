<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PhieuYeuCau extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('KiemTraQuyen:quan_ly_phieu_yeu_cau',
        ['only'=>['index','create','delete','edit','update','store'] ]);
    } 
    public function index()
    {
        $mang =  \App\Model\phieuyeucau::paginate(5);
        for ($i = 0 ;$i <count($mang) ;$i++)
            $mang[$i]->ngayDat = Carbon::parse($mang[$i]->ngayDat);        

        return \view('backend.pages.phieuyeucau.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $nhanvien = \App\Model\nhanvien::all();
        $nhaXB = \App\Model\nhaxb::all();
        return \view('backend.pages.phieuyeucau.create',['itemnhanvien'=>$nhanvien,'itemnhaxb'=>$nhaXB]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phieuyc = new \App\Model\phieuyeucau();
        $phieuyc->ID_NhanVien = $request->ID_NhanVien;
        $phieuyc->ID_NhaXB = $request->ID_NhaXB;
        $phieuyc->ngayDat = Carbon::now();
        $phieuyc->save();
        
      
        foreach($request->chitiet as $sach){
            DB::table('chitietphieuyeucaus')->insert([
                'ID_Sach'=>$sach['sach'],
                'ID_PhieuYeuCau'=>$phieuyc->id,
                'soLuong'=>$sach['soLuong']
            ]);
        }
        return \response()->json(['yes'=>true],200);

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
        $phieuyc = \App\Model\phieuyeucau::find($id);
        return view('backend.pages.phieuyeucau.edit')->with(['item'=>$phieuyc]);
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
        $phieuyc = \App\Model\phieuyeucau::find($id);
        $phieuyc->ID_NhanVien = $request->ID_NhanVien;
        $phieuyc->ID_NhaXB = $request->ID_NhaXB;
        $phieuyc->save();
        foreach($request->chitiet as $sach){
            DB::table('chitietphieuyeucaus')->update([
                'soLuong'=>$sach['soLuong']
            ]);
        }
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
        \App\Model\phieuyeucau::destroy($id);
        return \response()->json(['yes'=>true],200);

    }


    
    function pagination(Request $request){
        if($request->ajax()){
            
            $mang =  \App\Model\phieuyeucau::paginate(5);     
            for ($i = 0 ;$i <count($mang) ;$i++)
            $mang[$i]->ngayDat = Carbon::parse($mang[$i]->ngayDat);     
          return  
          view('backend.pages.phieuyeucau.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }



    public function get_nhaXB_sach (Request $request){
        $nxb = \App\Model\nhaxb::find($request->ID_NhaXB); 
        return view('backend.pages.phieuyeucau.select_sach_nhaxb')->with(['item'=>$nxb])->render();
    }

    public function them_chitiet(Request $request,$id){
        
        $sach = \App\Model\sach::find($id);
        $data = view('backend.pages.phieuyeucau.row_chitiet')->with(['item'=>$sach,'soLuong'=>$request->soLuong])->render();
        return \response()->json(['yes'=>true,'data'=>$data],200);
    }

    public function kttontai ($id){
        $kt=\App\Model\phieuyeucau::find($id);
        if($kt){
            return \response()->json(['yes'=>true],200);
        }else{
            return \response()->json(['yes'=>false],200);
        }
    }
}
