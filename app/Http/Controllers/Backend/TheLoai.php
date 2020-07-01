<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ViewBag;
use Illuminate\Support\Facades\DB;

class TheLoai extends Controller
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
        $mang =  DB::table('theloais')->paginate(5);
        return \view('backend.pages.theloai.index')->with(['arr'=>$mang,'page'=>1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $html = TheLoai::cayTheLoai();
       
        return view('backend.pages.theloai.create')->with(['html'=>$html]);

    }
      

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $table = new \App\Model\theloai();
         $table->tenTheLoai = $request->get('tenTheLoai');
         $table->mieuTa = $request->mieuTa;
         $table->ID_Cha = $request->theLoai;
         $table->save();
         if($table->ID_Cha != 0){
             $tab = \App\Model\theloai::where('id',$table->ID_Cha)->first();
             $tab->soLuongNode ++;
             $tab->save(); 
         }
        $ob = (object)[
            'tenTheLoai'=>$table->tenTheLoai,
            'id'=>$table->id,
            ];
    

        $html ="";
        $html = TheLoai::soanHTML($ob,1);

        // return view('test')->with(['html',$html]);
      

        

        return \response()->json(
            [
                'yes'=>true,
                'result'=>$html
            ]
            ,200
        );
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
        $theLoai = \App\Model\theloai::find($id);
        $html = TheLoai::cayTheLoai();
        return view('backend.pages.theloai.edit')->with(['theloai'=>$theLoai,'html'=>$html]);
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
        // B1 giong ham xoa
        // B2 sua
    
        $node = \App\Model\theloai::find($id);
        // dd($request);
        if($node->ID_Cha != 0 && $node->ID_Cha != $request->theLoai){
            $cha_ = \App\Model\theloai::where('id',$node->ID_Cha)->first();
            $cha_->soLuongNode = $cha_->soLuongNode-1;
            $cha_->save();
           
        }

        $node->tenTheLoai = $request->tenTheLoai;
        $node->ID_Cha = $request->theLoai;
        $node->mieuTa = $request->mieuTa;
        
        $node->save();
        if($node->ID_Cha != 0){
            $cha = \App\Model\theloai::where('id',$node->ID_Cha)->first();
            $cha->soLuongNode ++;
            $cha->save();
        } 
        return \back()->with($node->id);
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $node = \App\Model\theloai::find($id);

        // Neu xoa node con
        // B1. cap nhat soluong node con cua node cha giam di 1 
        // B2. Trong tuonng hop cha dang o nut goc thi khong can iam
        // B2. xoa node
        if( $node->soLuongNode == 0){
            if($node->ID_Cha != 0){
               $cha = \App\Model\theloai::find($node->ID_Cha);
               $cha->soLuongNode --;
               $cha->save();
            }
        }
        // Truong hop node dang xoa khong phai la node la 
        // B1. Cap nhat tat ca cac node con cua node chuyen len node co cap bac tren
        // VD :      1 
        //       2       3 
        //     4   5  
        // se thanh
        //           1 
        //     4     5     3 
        // B2. Trong tuonng hop cha dang o nut goc thi khong can iam
        // B3. cap nhat soluongNode cua node cha tang len bang so luong node con duoc chuyen len
        // B2. xoa node     

        else{
            $mangCon = \App\Model\theloai::where('ID_Cha',$id)->get(); 
            $c = true;
            if($node->ID_Cha != 0){
               $cha = \App\Model\theloai::find($node->ID_Cha);
               $cha->soLuongNode += $mangCon->count()-1;
               $cha->save();
               $c = false;
            }
            
            foreach($mangCon as $con){
                $con->ID_Cha = $c  ? 0 :$cha->id ;
                $con->save();
            }  
        }
        \App\Model\theloai::destroy($id);

        return \response()->json(['size'=>\App\Model\theloai::count()],200);
    }


    //// paginate()
    public function pagination(Request $request){
        
        if($request->ajax()){
            
            $mang =  DB::table('theloais')->paginate(5);
           
          return 
          view('backend.pages.theloai.phantrang')->with(['arr'=>$mang,'page'=>$request->page])->render();
        }
    }
    
    /// cac ham xu ly khac

    /// khoi tao cay 
    function cayTheLoai(){
        $mang =  \App\Model\theloai::all();
        $pre_parent= 0;
        $parent = 0;
        $count = $mang->count();
        $html = "";
        if($count == 0) 
        return view('backend.pages.theloai.create')->with(['html'=>$html]);
        $trangThai =  array();
        $demThe = 0;
        // Khoi tao mang trang thai
        for($i = 0;$i < $count ; $i++)array_push($trangThai, 0);
        $index  = 0;
        

        // echo "Test";
        
       
     
        while($index < $count){
           
            for($i = 0;$i < $count ; $i++){
                 // if ($trangThai[$i] != 0) continue;
                if($trangThai[$i] == 0&& $parent == $mang[$i]->ID_Cha){
                    // Them Vao 
                  
                    $index++;
                    $trangThai[$i] =1;
                    if($mang[$i]->soLuongNode != 0){
                        $temp = $parent;
                        $parent = $mang[$i]->id;
                        $pre_parent = $temp; 
                        $html .= TheLoai::soanHTML($mang[$i],2);
                        $demThe ++;
                    }
                    else{
                        $html .= TheLoai::soanHTML($mang[$i],1);
                    }
                    // echo $mang[$i]->tenTheLoai ."</br>"; 

                }
                if($i == $count-1 && $demThe != 0) {
                       
                    $html .= TheLoai::soanHTML($mang[$i],3); 
                    $demThe -=1;
             }
               
            }

            
            $parent = $pre_parent;
            foreach($mang as $m) {
                if($m->id === $pre_parent) $pre_parent = $m->ID_Cha;
                break;
            }

            
        }
        return $html;
    }

    /// saon cau truc html
    private function soanHTML($ele , $mode){

        
        $html = "";
         if($mode == 1 ){
         $html = "
         <ul class= \" theLoai nav nav-bar\">
             <li class=\" font-muli nav-item\" id = \"li-{$ele->id}\">
                 <label class=\"myRadio\" for=\"theloai-{$ele->id}\">
                     <input value = {$ele->id} type=\"radio\" style=\"display: contents;\" name=\"theLoai\" id=\"theloai-{$ele->id}\">
                     <span class=\"custom-tick\"></span>
                     <span>{$ele->tenTheLoai} </span>
                 </label>
                 
             </li>
            
         </ul>
       ";
     }
        else if($mode == 2){
         $html = "
         <ul class= \"theLoai nav nav-bar\">
             <li class=\" font-muli nav-item\" id = \"li-{$ele->id}\">
                 <label class=\"myRadio\" for=\"theloai-{$ele->id}\">
                     <input  value = {$ele->id} type=\"radio\" style=\"display: contents;\" name=\"theLoai\" id=\"theloai-{$ele->id}\">
                     <span class=\"custom-tick\"></span>
                     <span>{$ele->tenTheLoai} </span>
                 </label>";
          
        }else{
            $html = "</li>
            
            </ul>
          ";
        }
       
         return $html;
     }
}
