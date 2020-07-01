<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TacGia extends Controller
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
        $mang =  DB::table('tacgias')->paginate(5);
        return \view('backend.pages.tacgia.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('backend.pages.tacgia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tacgia = new \App\Model\tacgia();
        $tacgia->hoTen = $request->hoTen;
        $tacgia->namSinh = $request->namSinh;
        $tacgia->namMat = $request->namMat;
        $tacgia->quocTich = $request->quocTich;
        $tacgia->tomTat = $request->tomTat;
        $tacgia->save();
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
    {   $tacgia=\App\Model\tacgia::find($id);
        if($tacgia != null){
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
        $tacgia =  \App\Model\tacgia::find($id);
        return view('backend.pages.tacgia.edit')->with(['item'=>$tacgia]);
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
        $tacgia =  \App\Model\tacgia::find($id);
        $tacgia->hoTen = $request->hoTen;
        $tacgia->namSinh = $request->namSinh;
        $tacgia->namMat = $request->namMat;
        $tacgia->quocTich = $request->quocTich;
        $tacgia->tomTat = $request->tomTat;
        $tacgia->save();
        
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
        \App\Model\tacgia::destroy($id);
        return \response()->json(['size'=>\App\Model\tacgia::count()],200);
    }




    /////


    function pagination(Request $request){
        if($request->ajax()){
            
            $mang =  DB::table('tacgias')->paginate(5);
           
          return  
          view('backend.pages.tacgia.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }
}
