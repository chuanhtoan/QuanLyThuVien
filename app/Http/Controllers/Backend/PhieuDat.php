<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class PhieuDat extends Controller
{
    public function __construct(){
        $this->middleware('KiemTraQuyen:quan_ly_phieu_dat',['except'=>['index'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang = \App\Model\phieudat::paginate(5);
        for ($i = 0 ;$i <count($mang) ;$i++){
            $mang[$i]->ngayLap = Carbon::parse($mang[$i]->ngayLap);
        }
     
        
        return \view('backend.pages.phieudat.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docgia =  DB::table('docgias')->select('id', 'hoTen')->get();
        $nhanvien =  DB::table('nhanviens')->select('id', 'hoTen')->get();
        return \view('backend.pages.phieudat.create',['nhanvien'=>$nhanvien, 'itemdocgia'=>$docgia, 'itemnhanvien'=>$nhanvien]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phieudat = new \App\Model\phieudat();
        $phieudat->ngayLap = Carbon::now('Asia/Ho_Chi_Minh');
        $phieudat->ID_DocGia = $request->ID_DocGia;
        $phieudat->ID_NhanVien = $request->ID_NhanVien;
        $phieudat->daSuDung = false;
        $phieudat->save();
        
        foreach ($request->chitiet as $ct){
           $csach= \App\Model\cuonsach::all()->where('hienThi',$ct)->first();
            $ct = DB::table('chitietphieudats')->insert([
                'ID_PhieuDat'=>$phieudat->id,
                'ID_CuonSach' => $csach->id
            ]);
            $csach->daMuon  = true;
            $csach->save();
        }
        
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
        $phieudat =  \App\Model\phieudat::find($id);
        $docgia =  DB::table('docgias')->select('id', 'hoTen')->get();
        $nhanvien =  DB::table('nhanviens')->select('id', 'hoTen')->get();
        $phieudat->ngayLap = Carbon::parse($phieudat->ngayLap);
        return view('backend.pages.phieudat.edit')->with(['phieudat'=>$phieudat, 'itemdocgia'=>$docgia, 'itemnhanvien'=>$nhanvien,'page'=>1]);
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
        $phieudat =  \App\Model\phieudat::find($id);
        $phieudat->ID_DocGia = $request->ID_DocGia;
        $phieudat->ID_NhanVien = $request->ID_NhanVien; 
        $phieudat->save();
        // Xoa chi tit phieu muon va cap nhat la cuon sach
        $ct = DB::table('chitietphieudats')->where('ID_PhieuDat',$id)->get();
      
        if($phieudat->daTra == false){
        foreach($ct as $c){
            $s = \App\Model\cuonsach::all()->find($c->ID_CuonSach)->first();
            $s->daMuon = false;
            $s->save();
            // DB::table('chitietphieudats')->find($c->id)->delete();
        }}
        if($ct)
           DB::table('chitietphieudats')->where('ID_phieudat',$id)->delete();
        // luu lai
        foreach ($request->chitiet as $ct_){
             $csach= \App\Model\cuonsach::all()->where('hienThi',$ct_)->first();
             DB::table('chitietphieudats')->insert([
                 'ID_phieudat'=>$phieudat->id,
                 'ID_CuonSach' => $csach->id
             ]);
             $csach->daMuon  = true;
             $csach->save();
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
        \App\Model\phieudat::destroy($id);
      
        return \response()->json(['size'=>\App\Model\phieudat::count()],200);
    }


    function pagination(Request $request){
        if($request->ajax()){
            
            $mang = \App\Model\phieudat::paginate(5);
            for ($i = 0 ;$i <count($mang) ;$i++){
                $mang[$i]->ngayLap = Carbon::parse($mang[$i]->ngayLap);
            }        
          return  
          view('backend.pages.phieudat.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }


    protected $SO_LUONG_TOI_DA_DUOC_DAT= 7;
    public  function them_chitiet(Request $request,$id){
        $c = \App\Model\cuonsach::all()->where('hienThi',$id)->where('daMuon','0')->first();
        // dd($request->obj);
        $pm = \App\Model\docgia::find($request->docGia)->phieudats()->where('daSuDung','0')->get();

        // dd($pm);
        
        $soLuong = 0;
        foreach($pm as $p){
           $soLuong += $p->soLuongSach;
        }
        if($request->obj)
          $soLuong+=count($request->obj);


        if($soLuong+1 > $this->SO_LUONG_TOI_DA_DUOC_DAT) 
            return \response()->json(['yes'=>1],200);
        else if($c){
            $data = \view('backend.pages.sach.row_chitiet')->with(['item'=>$c,'index'=>1])->render();
            return \response()->json(['yes'=>0,'data'=>$data],200);
        }
        else
           return \response()->json(['yes'=>2],200);

    }

}
