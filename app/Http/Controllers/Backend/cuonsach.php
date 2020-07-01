<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class cuonsach extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


   // Hien thi dong tren phieu muon, tra, dat, nhap 
    public function get($id){
        $c = \App\Model\cuonsach::all()->where('hienThi',$id)->where('daMuon','0')->first();

        $data = \view('backend.pages.sach.row_chitiet')->with(['item'=>$c,'index'=>1])->render();
        // dd($c);
        if($c != null)
            return \response()->json(['yes'=>true,'data'=>$data],200);
        else
            return \response()->json(['yes'=>false],200);
    }



    // ham de phuc vu viec them vao chi tiet muon, tra, dat, nhap
    public function them_chitiet($id){
        $c = \App\Model\cuonsach::all()->where('hienThi',$id)->where('daMuon','0')->first();
        if($c != null){
            $c->daMuon = true;
            $c->save();
            $data = \view('backend.pages.sach.row_chitiet')->with(['item'=>$c,'index'=>1])->render();
            return \response()->json(['yes'=>true,'data'=>$data],200);
        }
        else
        return \response()->json(['yes'=>false],200);
    }

    public function xoa_chitiet(Request $request,$id){
        $c = \App\Model\cuonsach::all()->where('hienThi',$id)->first();
        if($c != null){
            $c->daMuon = false;
            $c->save();
            return \response()->json(['yes'=>true],200);
        }
        else
        return \response()->json(['yes'=>false],200);
    }
}
