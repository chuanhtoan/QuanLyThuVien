<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Quyen extends Controller
{
    public function __construct(){
        $this->middleware('KiemTraQuyen:ALL',['except'=>['index'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mang =  DB::table('quyens')->paginate(5);
        return \view('backend.pages.quyen.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('backend.pages.quyen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quyen = new \App\Model\Quyen();
        $quyen->maQuyen = $request->maQuyen;
        $quyen->tenQuyen = $request->tenQuyen;
        $quyen->moTa = $request->moTa;
        $quyen->save();
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
    {   $quyen=\App\Model\quyen::find($id);
        if($quyen != null){
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
        $quyen =  \App\Model\quyen::find($id);
        return view('backend.pages.quyen.edit')->with(['item'=>$quyen]);
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
        $quyen =  \App\Model\Quyen::find($id);
        $quyen->tenQuyen = $request->tenQuyen;
        $quyen->maQuyen = $request->maQuyen;
        $quyen->moTa = $request->moTa;
        $quyen->save();
        
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
        \App\Model\quyen::destroy($id);
        return \response()->json(['size'=>\App\Model\quyen::count()],200);
    }




    /////


    function pagination(Request $request){
        if($request->ajax()){
            
            $mang =  DB::table('quyens')->paginate(5);
           
          return  
          view('backend.pages.quyen.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }
}
