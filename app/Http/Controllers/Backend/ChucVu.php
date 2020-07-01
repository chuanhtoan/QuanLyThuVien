<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ChucVu extends Controller
{

    public function __construct(){
        $this->middleware('KiemTraQuyen:ALL',['except'=>['index','show'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mang = \App\Model\chucvu::paginate(5);
        return view('backend.pages.chucvu.index')->with(['page'=>1,'arr'=>$mang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = \App\Model\Quyen::all();
        return view('backend.pages.chucvu.create',['item'=>$item]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chucvu = new \App\Model\chucvu();
        $chucvu->tenChucVu = $request->tenChucVu;
        $chucvu->save();
        
        for ($i =0;$i < count($request->chucVu);$i++)
            DB::table('chucvu_quyen')->insert([
                'ID_ChucVu' => $chucvu->id,
                'ID_Quyen'  => $request->chucVu[$i]
        ]);
        return \response()->json(['yes'=>'true'],200);
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
        $cv = \App\Model\chucvu::find($id)->first();
        $item = \App\Model\Quyen::all();
        return view('backend.pages.chucvu.edit',['item'=>$item,'cv'=>$cv]);
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
      


        $chucvu = \App\Model\chucvu::find($id)->first();
        $chucvu->tenChucVu = $request->tenChucVu;
        $chucvu->save();

        DB::table('chucvu_quyen')->where('ID_ChucVu',$id)->delete();
        for ($i =0;$i < count($request->chucVu);$i++)
            DB::table('chucvu_quyen')->insert([
                'ID_ChucVu' => $id,
                'ID_Quyen'  => $request->chucVu[$i]
        ]);
        return \response()->json(['yes'=>'true'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('chucvu_quyen')->where('ID_ChucVu',$id)->delete();
        \App\Model\chucvu::destroy($id);
        return \response()->json(['size'=>\App\Model\chucvu::count()],200);

    }

    function pagination(Request $request){
        if($request->ajax()){
            
            $mang = \App\Model\chucvu::paginate(5);
           
          return  
          view('backend.pages.chucvu.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
        
    }
}
