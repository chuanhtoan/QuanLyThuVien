<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PhieuMuon extends Controller
{ 
    public function __construct(){
            $this->middleware('KiemTraQuyen:quan_ly_phieu_muon',['except'=>['index'] ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang = DB::table('phieumuons')->join('docgias','phieumuons.ID_DocGia','=','docgias.id')
                   ->join('nhanviens','phieumuons.ID_NhanVien','=','nhanviens.id')
                   ->select(['phieumuons.id','phieumuons.ngayMuon as ngayMuon','phieumuons.ngayHenTra as ngayHenTra','nhanviens.hoTen as tenNhanVien','docgias.hoTen as tenDocGia'])->paginate(5);
        for ($i = 0 ;$i <count($mang) ;$i++){
            $mang[$i]->ngayMuon = Carbon::parse($mang[$i]->ngayMuon);
            $mang[$i]->ngayHenTra = Carbon::parse($mang[$i]->ngayHenTra);
        }
     
        
        return \view('backend.pages.phieumuon.index')->with(['arr'=>$mang,'page'=>1]);
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
        return \view('backend.pages.phieumuon.create',['nhanvien'=>$nhanvien, 'itemdocgia'=>$docgia, 'itemnhanvien'=>$nhanvien]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $phieumuon = new \App\Model\phieumuon();
        $phieumuon->ngayMuon = Carbon::now('Asia/Ho_Chi_Minh');
        $phieumuon->ngayHenTra = Carbon::parse($request->ngayHenTra);
        $phieumuon->ID_DocGia = $request->ID_DocGia;
        $phieumuon->ID_NhanVien = $request->ID_NhanVien;
        $phieumuon->daTra = false;
        $phieumuon->soLuongSach = count($request->chitiet);
        $phieumuon->save();
        
        foreach ($request->chitiet as $ct){
           $csach= \App\Model\cuonsach::all()->where('hienThi',$ct)->first();
            $ct = DB::table('chitietphieumuons')->insert([
                'ID_PhieuMuon'=>$phieumuon->id,
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
        // $phieumuon=\App\Model\phieumuon::find($id);
        // if($phieumuon != null){
        //     return \response()->json(['yes'=>'true'],200);
        // }
        // else 
        //     return \response()->json(['yes'=>'false'],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phieumuon =  \App\Model\phieumuon::find($id);
        $docgia =  DB::table('docgias')->select('id', 'hoTen')->get();
        $nhanvien =  DB::table('nhanviens')->select('id', 'hoTen')->get();
        $phieumuon->ngayHenTra = Carbon::parse($phieumuon->ngayHenTra);
        $phieumuon->ngayMuon = Carbon::parse($phieumuon->ngayMuon);
        return view('backend.pages.phieumuon.edit')->with(['phieumuon'=>$phieumuon, 'itemdocgia'=>$docgia, 'itemnhanvien'=>$nhanvien,'page'=>1]);
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
        $phieumuon =  \App\Model\phieumuon::find($id);
        $phieumuon->ngayHenTra = Carbon::parse($request->ngayHenTra);
        $phieumuon->ID_DocGia = $request->ID_DocGia;
        $phieumuon->ID_NhanVien = $request->ID_NhanVien; 
        $phieumuon->soLuongSach = count($request->chitiet);
        $phieumuon->save();
        // Xoa chi tit phieu muon va cap nhat la cuon sach
        $ct = DB::table('chitietphieumuons')->where('ID_PhieuMuon',$id)->get();
      
        if($phieumuon->daTra == false){
        foreach($ct as $c){
            $s = \App\Model\cuonsach::all()->find($c->ID_CuonSach)->first();
            $s->daMuon = false;
            $s->save();
            // DB::table('chitietphieumuons')->find($c->id)->delete();
        }}
        if($ct)
           DB::table('chitietphieumuons')->where('ID_PhieuMuon',$id)->delete();
        // luu lai
        foreach ($request->chitiet as $ct_){
             $csach= \App\Model\cuonsach::all()->where('hienThi',$ct_)->first();
             DB::table('chitietphieumuons')->insert([
                 'ID_PhieuMuon'=>$phieumuon->id,
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
        $pm = \App\Model\phieumuon::find($id);
        
        $ct = DB::table('chitietphieumuons')->where('ID_PhieuMuon',$id)->get();
        if($pm->daTra == false){
        foreach($ct as $c){
        //   echo($c->ID_CuonSach . ' ');  
          DB::table('cuonsachs')->where('id',$c->ID_CuonSach)->update([
              'daMuon'=>false
          ]);
            // DB::table('chitietphieumuons')->find($c->id)->delete();
        }
      }
        if($ct)
           DB::table('chitietphieumuons')->where('ID_PhieuMuon',$id)->delete();
        
        \App\Model\phieumuon::destroy($id);
      
        return \response()->json(['size'=>\App\Model\phieumuon::count()],200);
    }




    /////


    function pagination(Request $request){
        if($request->ajax()){
            
            $mang = DB::table('phieumuons')->join('docgias','phieumuons.ID_DocGia','=','docgias.id')
            ->join('nhanviens','phieumuons.ID_NhanVien','=','nhanviens.id')
            ->select(['phieumuons.id','phieumuons.ngayMuon as ngayMuon','phieumuons.ngayHenTra as ngayHenTra','nhanviens.hoTen as tenNhanVien','docgias.hoTen as tenDocGia'])->paginate(5);
            for ($i = 0 ;$i <count($mang) ;$i++){
                $mang[$i]->ngayMuon = Carbon::parse($mang[$i]->ngayMuon);
                $mang[$i]->ngayHenTra = Carbon::parse($mang[$i]->ngayHenTra);
            }           
          return  
          view('backend.pages.phieumuon.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }


    protected $SO_LUONG_TOI_DA_DUOC_MUON= 7;
    public  function them_chitiet(Request $request,$id){
        $c = \App\Model\cuonsach::all()->where('hienThi',$id)->where('daMuon','0')->first();
        if(!$c){
            $pd = \App\Model\docgia::find($request->docGia)->phieudats()->where('daSuDung','0')->get();
            foreach($pd as $d){
                foreach($d->cuonsachs()->get() as $cs){
                    if($cs->hienThi == $id){
                        $c = $cs;
                        break;
                    }
                }

                if($c)break;
            }
        }
        // dd($request->obj);
       
       
        $pm = \App\Model\docgia::find($request->docGia)->phieumuons()->where('daTra','0')->get();

        // dd($pm);
        
        $soLuong = 0;
        foreach($pm as $p){
           $soLuong += $p->soLuongSach;
        }
        if($request->obj)
          $soLuong+=count($request->obj);


        if($soLuong+1 > $this->SO_LUONG_TOI_DA_DUOC_MUON) 
            return \response()->json(['yes'=>1],200);
        else if($c){
            $data = \view('backend.pages.sach.row_chitiet')->with(['item'=>$c,'index'=>1])->render();
            return \response()->json(['yes'=>0,'data'=>$data],200);
        }
        else
        return \response()->json(['yes'=>2],200);

    }


    public function kiemTraTonTai($id){
        $phieumuon=\App\Model\phieumuon::find($id);
        if($phieumuon != null){
            return \response()->json(['yes'=>'true','docgia'=>$phieumuon->docgia()->first()->hoTen],200);
        }
        else 
            return \response()->json(['yes'=>'false'],200);
    }


    public function review($id){
       
        $phieumuon = \App\Model\phieumuon::find($id);
        $phieumuon->ngayHenTra = Carbon::parse($phieumuon->ngayHenTra);
        $phieumuon->ngayMuon = Carbon::parse($phieumuon->ngayMuon);
        return view ('backend.pages.phieumuon.review')->with(['phieumuon'=>$phieumuon])->render();
    }

    public function new_review(){
        return view ('backend.pages.phieumuon.new_review');
    }
}
