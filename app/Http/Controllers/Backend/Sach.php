<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use File;
class Sach extends Controller
{


    public function __construct(){
       $this->middleware('KiemTraQuyen:quan_ly_sach',['except'=>['index'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $mang = DB::table('saches')->join('theloais','saches.ID_TheLoai','=','theloais.id')
                   ->join('tacgias','saches.ID_TacGia','=','tacgias.id')
                   ->join('nhaxbs','saches.ID_NXB','=','nhaxbs.id')
                   ->select(['saches.id','saches.tenSach','nhaxbs.tenNXB','tacgias.hoTen','theloais.tenTheLoai','saches.gia'
                   ,'saches.duocPhepMuon'])->paginate(5);

       return view('backend.pages.sach.index')->with(['arr'=>$mang,'page'=>1]);          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = \App\Model\theloai::all();
        $tacgia = \App\Model\tacgia::all();
        $nxb = \App\Model\nhaxb::all(); 
      
        return \view('backend.pages.sach.create',['nxb'=>$nxb,'tacgia'=>$tacgia,'theloai'=>$theloai]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sach = new \App\Model\sach();
        $sach->tenSach = $request->tenSach;
        $sach->ID_TacGia = $request->ID_TacGia;
        $sach->ID_TheLoai = $request->ID_TheLoai;
        $sach->ID_NXB = $request->ID_NXB;
        $sach->namXB = $request->namXB;
        $sach->gia = $request->gia;
        $sach->vietTat = $request->vietTat;
        $sach->duocPhepMuon = $request->duocPhepMuon;
        $anh = $request->file('anhbia');
        // return $request->file('anhbia');
        if($anh){  
            $tenanh = $anh->getClientOriginalName();

           $tenanh_ = explode('.',$tenanh)[0];
           $_tenanh = explode('.',$tenanh)[1];
           $tenanh = $tenanh_ .rand(0,100).".".$_tenanh;
           
           $anh->move('img/bia',$tenanh);
           $sach->anhBia = $tenanh;
           $sach->save();
        } else{
            $sach->save();
        }

      
        return \response()->json(
            ['s'=>true],200);
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
        $sach = \App\Model\sach::find($id);
        $theloai = \App\Model\theloai::all();
        $tacgia = \App\Model\tacgia::all();
        $nxb = \App\Model\nhaxb::all(); 
      
        return \view('backend.pages.sach.edit',['nxb'=>$nxb,'tacgia'=>$tacgia,'theloai'=>$theloai,'sach'=>$sach]);
       
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
        $sach = \App\Model\sach::find($id);
        $sach->tenSach = $request->tenSach;
        $sach->ID_TacGia = $request->tacgia;
        $sach->ID_TheLoai = $request->theLoai;
        $sach->ID_NXB = $request->nxb;
        $sach->namXB = $request->namxb;
        $sach->gia = $request->gia;
        $sach->vietTat = $request->vietTat;
        $sach->duocPhepMuon = $request->choMuon;
        $anh = $request->file('anhbia');
        // dd ($request->tacgia);
        
        if($anh && $request->anhbia != $sach->anhBia){
            if(File::exists('img/bia/'.$sach->anhBia))
                File::delete('img/bia/'.$sach->anhBia);
           
            $tenanh = $anh->getClientOriginalName();
        //    dd($tenanh);
           
           $tenanh_ = explode('.',$tenanh)[0];
           $_tenanh = explode('.',$tenanh)[1];
           $tenanh = $tenanh_ .rand(0,100).".".$_tenanh;
           
           $anh->move('img/bia',$tenanh);
           $sach->anhBia = $tenanh;
           $sach->save();
        } else{
            $sach->save();
        }
        // return \response()->json(
        //     ['s'=>true],200);
        $theloai = \App\Model\theloai::all();
        $tacgia = \App\Model\tacgia::all();
        $nxb = \App\Model\nhaxb::all(); 
        return  \back()->with($sach->id);
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Model\sach::destroy($id);

        return \response()->json(['size'=>\App\Model\sach::count()]);
    }

    public function pagination(Request $request){

        if($request->ajax()){
            
            $mang = DB::table('saches')->join('theloais','saches.ID_TheLoai','=','theloais.id')
            ->join('tacgias','saches.ID_TacGia','=','tacgias.id')
            ->join('nhaxbs','saches.ID_NXB','=','nhaxbs.id')
            ->select(['saches.id','saches.tenSach','nhaxbs.tenNXB','tacgias.hoTen','theloais.tenTheLoai','saches.gia'
            ,'saches.duocPhepMuon'])->paginate(5);
    
            return view('backend.pages.sach.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();   
        }
               
    
    }
    public function write(Request $request, $id){
       $review = $request->review;
       $sach = \App\Model\sach::find($id);
       $sach->mieuTa = $review;
       $sach->save();
       return  \back()->with(['dulieu'=>$sach->mieuTa,'id'=>$id]);
    }

    public function review($id){
        $sach = \App\Model\sach::find($id);
        return view('backend.pages.sach.write')->with(['dulieu'=>$sach->mieuTa,'id'=>$id]);
    }
}
