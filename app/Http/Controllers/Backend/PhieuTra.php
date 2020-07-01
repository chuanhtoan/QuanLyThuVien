<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PhieuTra extends Controller
{
    public function __construct(){
        $this->middleware('KiemTraQuyen:quan_ly_phieu_tra',['except'=>['index'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang = DB::table('phieutras')->join('phieumuons','phieutras.ID_PhieuMuon','=','phieumuons.id')
                   ->join('nhanviens','phieutras.ID_NhanVien','=','nhanviens.id')
                   ->select(['phieutras.id','phieutras.ngayTra','phieumuons.id as idphieumuon','nhanviens.hoTen as tenNhanVien',])->paginate(5);
        for ($i = 0 ;$i <count($mang) ;$i++)
            $mang[$i]->ngayTra = Carbon::parse($mang[$i]->ngayTra);        

        return \view('backend.pages.phieutra.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $phieutra =  DB::table('phieumuons')->select('id')->get();
        $nhanvien =  DB::table('nhanviens')->select('id', 'hoTen')->get();
        return \view('backend.pages.phieutra.create',['itemphieumuon'=>$phieutra, 'itemnhanvien'=>$nhanvien]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phieutra = new \App\Model\phieutra();
        $phieutra->ngayTra = Carbon::now();
        $phieutra->ID_PhieuMuon = $request->ID_PhieuMuon;
        $phieutra->ID_NhanVien = $request->ID_NhanVien;
        $phieutra->save();
        DB::table('phieumuons')->where('id',$phieutra->ID_PhieuMuon)->update([
            'daTra'=>true]
        );
        foreach ($request->chitiet as $ct){
           $csach= \App\Model\cuonsach::all()->where('hienThi',$ct)->first();
            $ct = DB::table('chitietphieutras')->insert([
                'ID_PhieuTra'=>$phieutra->id,
                'ID_CuonSach' => $csach->id
            ]);
            $csach->daMuon  = false;
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
    {   $phieutra=\App\Model\phieutra::find($id);
        if($phieutra != null){
            return \response()->json(['yes'=>true],200);
        }
        else return \response()->json(['yes'=>fasle],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phieutra =  \App\Model\phieutra::find($id);
        $phieutra->ngayTra = Carbon::parse($phieutra->ngayTra);
        // $phieutra =  DB::table('phieumuons')->select('id')->get();
        $nhanvien =  DB::table('nhanviens')->select('id', 'hoTen')->get();
        return view('backend.pages.phieutra.edit')->with(['item'=>$phieutra, 'itemnhanvien'=>$nhanvien]);
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
       
        $phieutra =  \App\Model\phieutra::find($id);
        // THAY DOI THUOC TINH DA MUON CUA TUNG CUON SACH 
        DB::table('phieumuons')->where('id',$phieutra->ID_PhieuMuon)->update([
            'daTra'=>true]
        );
        // B1 THAY DOI TAT CAC CAC SACH TRONG PHIEU TRA CU THANH DAMUON = FALSE
        $ct_cu = DB::table('chitietphieutras')->where('ID_PhieuTra',$phieutra->id)->get();
        
        foreach($ct_cu as $c){
            $s = \App\Model\cuonsach::all()->find($c->ID_CuonSach)->first();
            $s->daMuon = true;
            $s->save();
            // DB::table('chitietphieumuons')->find($c->id)->delete();
        }
        if($ct_cu)
            DB::table('chitietphieutras')->where('ID_PhieuTra',$phieutra->id)->delete();
        // B2 SET TAT CAC CAC CUON SACH TRONG PHIEU MOI THANH DAMUIN = TRUE
        // DONG THOI XOA TAT CAC CAC CHITIET_MUON CU VA CHEN VAO CHITIET_MOI
        foreach ($request->chitiet as $ct){
            $csach= \App\Model\cuonsach::all()->where('hienThi',$ct)->first();
             $ct = DB::table('chitietphieutras')->insert([
                 'ID_PhieuTra'=>$phieutra->id,
                 'ID_CuonSach' => $csach->id
             ]);
             $csach->daMuon  = false;
             $csach->save();
         }

        
        $phieutra->ID_NhanVien = $request->ID_NhanVien;
        $phieutra->save();
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
        \App\Model\phieutra::destroy($id);
        return \response()->json(['size'=>\App\Model\phieutra::count()],200);
    }




    /////


    function pagination(Request $request){
        if($request->ajax()){
            
            $mang = DB::table('phieutras')->join('phieumuons','phieutras.ID_PhieuMuon','=','phieumuons.id')
            ->join('nhanviens','phieutras.ID_NhanVien','=','nhanviens.id')
            ->select(['phieutras.id','phieutras.ngayTra','phieumuons.id as idphieumuon','nhanviens.hoTen as tenNhanVien',])->paginate(5);
            for ($i = 0 ;$i <count($mang) ;$i++){
                $mang[$i]->ngayTra = Carbon::parse($mang[$i]->ngayTra);
            }
            return  
               view('backend.pages.phieutra.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }

    public function them_chitiet(Request $request,$id){

      

        if($request->maPhieuMuon == null)  return \response()->json(['yes'=>2],200);
        $c = \App\Model\cuonsach::all()->where('hienThi',$id)->where('daMuon','1')->first();
        $pm = \App\Model\phieumuon::find($request->maPhieuMuon)->cuonsachs()->get();
        // echo(count($pm).' ' );
        $co = false;
        foreach($pm as $p){
            if($p->hienThi == $id){
                $co = true;
                // echo(' co ');
                break;
            }
        }

        // dd($co);
        if( $co && $c){
            $data = \view('backend.pages.sach.row_chitiet')->with(['item'=>$c])->render();
           
            return \response()->json(['yes'=>0,'data'=>$data],200);
        }else
        return \response()->json(['yes'=>1],200);
    }



    public function kiemTraViPham(Request $request){
        $phieumuon = \App\Model\phieumuon::find($request->maPhieuMuon);
        $result = [];
        if(count($request->chitiet) < $phieumuon->soLuongSach ){

            array_push($result,"Phiếu trả không đủ sách so với phiếu mượn thiếu "
            .( $phieumuon->soLuongSach - count($request->chitiet)) . " cuốn!</br>
             Nhắc nhở: nếu độc giả làm mất sách hãy tiến hành lập biên bản");
        } 
        
      
        $ngayHen = Carbon::parse($phieumuon->ngayHenTra);
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        if($ngayHen->diffInDays($now)<0){
            
            array_push($result,
            "Phiếu mượn đã quán hạn ". $ngayHen->diffInDays($now). " ngày 
            </br>Nhắc nhở: nếu đọc giả trả sách quá hạn thì hãy tiến hành lập biên bản");
        }


        // dd(($result));
        // ===== MOI THU DEU OK < KO CO VI PHAM
        if(count($result) == 0){
           return \response()->json(['size'=>0],200);
        }else{
            return \response()->json(['size'=>count($result),'mess'=>$result],200);
        }
    }
}
