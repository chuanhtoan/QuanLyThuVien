<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DocGia extends Controller
{

    public function __construct(){
        $this->middleware('KiemTraQuyen:quan_ly_doc_gia',['except'=>['index'] ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang =  DB::table('docgias')->paginate(5);
        return \view('backend.pages.docgia.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('backend.pages.docgia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $docgia = new \App\Model\docgia();
        $docgia->hoTen = $request->hoTen;
        $docgia->namSinh = $request->namSinh;
        $docgia->diaChi = $request->diaChi;
        $docgia->sdt = $request->sdt;
        $docgia->email = $request->email;
        $docgia->save();
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
    {   $docgia=\App\Model\docgia::find($id);
        if($docgia != null){
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
        $docgia =  \App\Model\docgia::find($id);
        return view('backend.pages.docgia.edit')->with(['item'=>$docgia]);
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
        $docgia =  \App\Model\docgia::find($id);
        $docgia->hoTen = $request->hoTen;
        $docgia->namSinh = $request->namSinh;
        $docgia->diaChi = $request->diaChi;
        $docgia->sdt = $request->sdt;
        $docgia->email = $request->email;
        $docgia->save();
        
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
        \App\Model\docgia::destroy($id);
        return \response()->json(['size'=>\App\Model\docgia::count()],200);
    }




    /////


    function pagination(Request $request){
        if($request->ajax()){
            
            $mang =  DB::table('docgias')->paginate(5);
           
          return  
          view('backend.pages.docgia.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }
}
