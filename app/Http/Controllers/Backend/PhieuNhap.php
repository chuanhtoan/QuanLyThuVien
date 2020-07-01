<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PhieuNhap extends Controller
{

    public function __construct(){
        $this->middleware('KiemTraQuyen:quan_ly_phieu_nhap',
        ['only'=>['index','create','delete','edit','update','store'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang =  \App\Model\phieunhap::paginate(5);
        for ($i = 0 ;$i <count($mang) ;$i++)
            $mang[$i]->ngayLap = Carbon::parse($mang[$i]->ngayLap);        

        return \view('backend.pages.phieunhap.index')->with(['arr'=>$mang,'page'=>1]);
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
        return \view('backend.pages.phieunhap.create',['itemnhanvien'=>$nhanvien,'itemnhaxb'=>$nhaXB]);
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // === B1. LUU PHIEU NHAP
        $phieunhap= new \App\Model\phieunhap();
        $phieunhap->ngayLap = Carbon::now();
        $phieunhap->ID_NhanVien = $request->ID_NhanVien;
        $phieunhap->ID_PhieuYeuCau = $request->ID_PhieuYeuCau;
        $phieunhap->gia = $request->gia;
        $phieunhap->ID_NhaXB = $request->ID_NhaXB;
        $phieunhap->save(); 
        
        foreach($request->chitiet as $ct){
        // === B2. KIEM TRA SACH CO TON TAI TRONG KHO CHUA 
        // === CO THI QUA BUOC B3
        // === CHUA THI XUAT THONG BAO YEU CAU TAO ROI QUA BUOC BA
           $sach = \App\Model\sach::find($ct['sach']);
        
        // === B3. TIEN HANH TAO MOI CAC CUON SACH
        // === LUU Y: MA HIEN THI TRONG CUON SACH SE LA MA VIET TAT CUA SACH + SOLUONG SACH TANG DAN
           for($i = 1;$i<=$ct['soLuong'];$i++){
                $cs = new \App\Model\cuonsach();
                $cs->ID_Sach = $sach->id;
                $cs->daMuon = false;
                $cs->hienThi = $sach->vietTat . '_'.($sach->soLuong + $i);
                $cs->save();
                DB::table('chitietphieunhaps')->insert([
                    'ID_CuonSach' => $cs->id,
                    'ID_PhieuNhap'=>$phieunhap->id   
                ]);
           }

           // === B4. TANG SO LUONG SACH TRONG KHO
           $sach->soLuong +=  $ct['soLuong'];
           $sach->save();
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
        //
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
        \App\Model\phieunhap::destroy($id);
        return \response()->json(['yes'=>true],200);
    }



    function pagination(Request $request){
        if($request->ajax()){
            
            $mang =  \App\Model\phieunhap::paginate(5);
            for ($i = 0 ;$i <count($mang) ;$i++)
               $mang[$i]->ngayLap = Carbon::parse($mang[$i]->ngayLap);     
          return  
          view('backend.pages.phieunhap.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }

    public function get_nhaXB_sach (Request $request){
        $nxb = \App\Model\nhaxb::find($request->ID_NhaXB); 
        return view('backend.pages.phieunhap.select_sach_nhaxb')->with(['item'=>$nxb])->render();
    }
    public function them_chitiet(Request $request,$id){
        
        $sach = \App\Model\sach::find($id);
        if($sach){
        
            $data = view('backend.pages.phieunhap.row_chitiet')->with(['item'=>$sach,'soLuong'=>$request->soLuong])->render();
            return \response()->json(['yes'=>true,'data'=>$data],200);
        }
        else{
            return \response()->json(['yes'=>false],200);
        }
    }
}
