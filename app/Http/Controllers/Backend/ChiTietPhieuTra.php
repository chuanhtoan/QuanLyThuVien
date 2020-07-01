<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ChiTietPhieuTra extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang = DB::table('chitietphieutras')->join('phieutras','chitietphieutras.ID_PhieuTra','=','phieutras.id')
                   ->join('cuonsachs','chitietphieutras.ID_CuonSach','=','cuonsachs.id')
                   ->select(['chitietphieutras.id','phieutras.id as idphieutra','cuonsachs.id as idcuonsach',])
                   ->paginate(5);
        return \view('backend.pages.chitietphieutra.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $phieutra =  DB::table('phieutras')->select('id')->get();
        $cuonsach =  DB::table('cuonsachs')->select('id')->get();
        return \view('backend.pages.chitietphieutra.create',['itemphieutra'=>$phieutra, 'itemcuonsach'=>$cuonsach]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chitietphieutra = new \App\Model\chitietphieutra();
        $chitietphieutra->ID_PhieuTra = $request->ID_PhieuTra;
        $chitietphieutra->ID_CuonSach = $request->ID_CuonSach;
        $chitietphieutra->save();
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
        $mang = DB::table('chitietphieutras')->join('phieutras','chitietphieutras.ID_PhieuTra','=','phieutras.id')
                   ->join('cuonsachs','chitietphieutras.ID_CuonSach','=','cuonsachs.id')
                   ->join('saches','cuonsachs.ID_Sach','saches.id')
                   ->join('nhanviens','phieutras.ID_NhanVien','=','nhanviens.id')
                   ->select(['chitietphieutras.id','phieutras.id as idphieutra','phieutras.ngayTra','cuonsachs.id as idcuonsach','nhanviens.hoTen as tennhanvien','cuonsachs.id as idcuonsach','saches.tenSach',])
                   ->where('phieutras.id',$id)
                   ->paginate(5);
        return \view('backend.pages.chitietphieutra.index')->with(['arr'=>$mang,'page'=>1]);
        // $chitietphieutra=\App\Model\chitietphieutra::find($id);
        // if($chitietphieutra != null){
        //     return \response()->json(['yes'=>true],200);
        // }
        // else return \response()->json(['yes'=>fasle],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chitietphieutra =  \App\Model\chitietphieutra::find($id);
        $cuonsach =  DB::table('cuonsachs')->select('id')->get();
        return view('backend.pages.chitietphieutra.edit')->with(['itemctpt'=>$chitietphieutra, 'itemcuonsach'=>$cuonsach]);
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
        $chitietphieutra =  \App\Model\chitietphieutra::find($id);
        $chitietphieutra->ID_CuonSach = $request->ID_CuonSach;
        $chitietphieutra->save();
        
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
        \App\Model\chitietphieutra::destroy($id);
        return \response()->json(['size'=>\App\Model\chitietphieutra::count()],200);
    }




    /////


    function pagination(Request $request){
        if($request->ajax()){
            
            $mang =  DB::table('chitietphieutras')->paginate(5);
           
          return  
          view('backend.pages.chitietphieutra.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }
}
