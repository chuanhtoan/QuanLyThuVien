<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class NXB extends Controller
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
        $mang =  DB::table('nhaxbs')->paginate(5);
        return \view('backend.pages.nxb.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('backend.pages.nxb.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nxb = new \App\Model\nhaxb();
        $nxb->tenNXB = $request->tenNXB;
        $nxb->email = $request->email;
        $nxb->sdt = $request->sdt;
    
        $nxb->save();
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
         $nhaxb=\App\Model\nhaxb::find($id);
        if($nhaxb != null){
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
        $nxb =  \App\Model\nhaxb::find($id);
        return view('backend.pages.nxb.edit')->with(['item'=>$nxb]);//
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
        $nxb =  \App\Model\nhaxb::find($id);
        $nxb->tenNXB = $request->tenNXB;
        $nxb->email = $request->email;
        $nxb->sdt = $request->sdt;
    
        $nxb->save();
        
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
        \App\Model\nhaxb::destroy($id);
        return \response()->json(['size'=>\App\Model\nhaxb::count()],200);
    }

    function pagination(Request $request){
        if($request->ajax()){
            
            $mang =  DB::table('nhaxbs')->paginate(5);
           
          return  
          view('backend.pages.nxb.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
    }
}
