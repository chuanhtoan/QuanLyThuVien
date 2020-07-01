@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    .myRadio span {
        margin-left: 1.5rem;
    }

    /* HET CHECK BOX */
    body {
        font-family: 'Muli', sans-serif;
    }

    .white-box label {
        font-weight: bold;
    }

    ul.theLoai {
        border-left: 0.5px solid black;
    }

    #nhanvienForm input {
        border: none;
        box-shadow: none;
        border-bottom: solid 0.7px rgb(179, 179, 179);
    }

    #nhanvienForm input:read-only {
        background-color: white;
    }


    .table-info tr {
        display: block;
        margin-top: 2.5rem;
    }

    .avatar {
        position: relative;

    }

    .avatar img {
        display: block;
        margin: 0;
        width: 75%;
        border-radius: 50%;
        margin: 0 auto;
        margin-bottom: 1rem;
    }

    .avatar input[type=file] {
        opacity: 0;
        z-index: -1;
        position: absolute;
    }

    .avatar button {
        display: none;
    }

    .label-title {
        padding-bottom: 2rem;
        display: block;
        border-bottom: 0.7px solid rgb(187, 187, 187);
        font-family: 'Noto Serif', serif;
        font-size: 2rem;
    }

    .danh-sach-quyen {
        font-family: 'Roboto', sans-serif;
        font-weight: bolder;
    }

    .danh-sach-quyen li {
        padding-left: 1rem;
        margin-top: 1rem;
    }

    .danh-sach-quyen li span {
        margin-left: 1rem;
    }

    .ten-quyen {
        background-color: #2cca79;
        /* background-color: rgb(153, 153, 238); */
        padding: 0.5rem;
        border-radius: 4px;
    }

    .danh-sach-quyen p {
        font-family: 'Noto Serif', serif;
        margin-top: 1rem;
    }
    .danh-sach-quyen .xoa-quyen {
        background-color: white;
        border: none;
        color: rgb(68, 68, 245);
    }

    /*  POPUP BOX */
    .hien-popup-box::before {

        position: absolute;
        background-color: rgba(51, 51, 51, 0.2);
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
        content: "";
    }

    .hien-popup-box .box {
        position: absolute;
        background-color: white !important;
        top: 50%;
        left: 50%;
        z-index: 11;
        width: 300px;
        transform: translateX(-50%, -50%);
        box-shadow: 0 0 5px 2px rgb(150, 150, 150);
        padding: 1rem 2rem 0 2rem;
    }

    .hien-popup-box .box .noi-dung {
        text-align: center;
        margin-top: 2rem;
        margin-bottom: 2rem;

    }

    .hien-popup-box .box .popup-box-exit {
        position: absolute;
        font-size: 2rem;
        top: 5px;
        right: 10px;
        cursor: pointer;

    }

    .hien-popup-box .box .title {
        font-size: 1.6rem;
        font-family: 'Noto Serif', serif;
        margin: 0;
        border-bottom: rgb(189, 189, 189) 0.4px solid;
        margin-bottom: 1rem;
    }

    .hien-popup-box .box .ok-chuc-vu {
        background-color: white;
        border-radius: 5px;
        padding: 2px 7px;
        color: black;
        border: solid 0.7px black;
    }

    .hien-popup-box .box .ok-chuc-vu:hover {
        background-color: rgb(50, 93, 231);
        color: white;
    }

    .hien-popup-box .box select[name=chucvu] {
        width: 180px;
        display: block;
        margin: 0 auto 20px auto;
    }


    /*  END POPUP BOX */
</style>
@endsection
{{-- {{$html}} --}}

@section('noi-dung')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title font-noto">Cá nhân/Tài khoản</h4>
            </div>
        </div>
        {{-- {{dd($data)}} --}}
        <div class="row">
            <div class="white-box " style="padding-left: 5rem; overflow: hidden;">

                <div class="row" style="margin-bottom: 9rem;">
                    <div class="col-md-8">

                        <table class="table-info ">
                            <label class="label-title">Thông tin tài khoản</label>
                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>ID tài khoản: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span id="idTK">{{$data->id}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>Tên tài khoản: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span>{{$data->tenTaiKhoan}}</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>Email: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span>{{$data->email}}</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>Ngày lập: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span>{{ $data->ngayLap->format('d/m/Y')}}</span>
                                </td>
                            </tr>

                        </table>

                    </div>
                    <div class="col-md-4">
                        <form method="post" action="{{route('taikhoan.avatar',$data->id)}}" id='form-avatar'
                            enctype="multipart/form-data" style="margin-bottom: 4rem;">
                            @csrf
                            <div class="avatar">
                                <img src="{{asset('img/avatar/admin/'.$data->avatar)}}" />
                                <label for="photo" class="btn btn-primary">Chọn file</label>
                                <input type="file" id="photo" name="photo" accept="image/*" />
                                <button class=" btn btn-success ">Lưu</button>
                            </div>
                        </form>

                        {{-- <div style="display: flex" >
                            <a class="btn btn-danger" style="margin-right: 2rem;">Cập nhật Email</a>
                            <a class="btn btn-info">Đổi mật khẩu</a>
                            
                         </div> --}}


                    </div>


                </div>

                <div class="row" style="margin-bottom: 5rem !important; ">

                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <label class="label-title">Quyền của tài khoản
                            <button type="button" style="float: right"
                                class="them-chuc-vu btn btn-success font-muli">Thêm</button>

                        </label>
                        
                        <div class="table-info quyen" id = "ds_admin_chucvu">
                            <ul class="danh-sach-quyen">
                                @include('backend.pages.taikhoan.list_admin_chucvu',['data'=>$data])
                            </ul>
                        </div>

                        <div class="text-center" style="margin-top: 5rem;">
                            {{-- <button  type="button" id="check" class="btn btn-primary">Lưu</button> --}}
                            {{-- <button type="button" class=" sua btn  btn-info">Sửa</button> --}}
                            <a href="{{route('nhanvien.index')}}"> <button type="button"
                                    class="btn btn-danger">Trở về</button></a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="hien-popup-box">

</div>
@endsection
@section('footer')
@parent
<script>
    const id =  window.location.toString().split('taikhoan/')[1].split('/')[0] ;
    $(document).ready(function () {
        $('.hien-popup-box').hide();
     
    });
    
    function showDialog(hien,data) {

        if(!hien){
            $('.hien-popup-box').hide();
        }
        else{ 
            $('.hien-popup-box').show();     
            $('.hien-popup-box').html(data);
        }
    }

    //// Cac su kien click vao button
//  ====================== THWM MOI CHUC VU =====================    

    $('.them-chuc-vu').click(function(){
       let data ;
       $.ajax({
                type      : 'get',
                async     : false,
                success   : function(data_) {
                   data = data_;
                },
                url       : '/admin/danhmuc/taikhoan/laychucvu/'+id,
                
            });   

     
       showDialog(true,data);
         
    });


//  ====================== XOA CHUC VU DANG CHON =====================    
    $(document).on('click','.danh-sach-quyen .xoa-quyen',function (e) {
        e.preventDefault();
       var idchucvu = $(this).val();
     
       console.log(idchucvu);     
        alertify.confirm (
          'Bạn có chắc bỏ chức vụ này ra khỏi tài khoản',
          function(){
             $.ajax({
                 type:'delete',
                 headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 url:'/admin/danhmuc/taikhoan/admin/'+id+'/chucvu/'+idchucvu,
                 success: function(data){
                     console.log(data);
                    $('.danh-sach-quyen').empty();
                    $('.danh-sach-quyen').html(data);
                    alertify.success("Đã xóa");
                 }
             });
          },
          function(){
              alertify.error('Chưa có gì xảy ra!!!');
          }
      );
       
    });



   $(document).on('click','.hien-popup-box .box .popup-box-exit',function (e) {
       $('.hien-popup-box').empty();
       $('.hien-popup-box').hide();
   });

   $(document).on('click','.hien-popup-box .box .ok-chuc-vu',function (e) {
       var idchucvu = $('.hien-popup-box #select-chuc-vu option:checked').val();
       console.log(idchucvu);

       $('.hien-popup-box').empty();
       $('.hien-popup-box').hide();
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       $.ajax({
           type:'post',
         
           url: '/admin/danhmuc/taikhoan/insert-admin/'+id+'/chucvu/'+idchucvu,
           success: function(data){
               $('#ds_admin_chucvu .danh-sach-quyen').append(data);     
               alertify.success('Thêm thành công');
           } 
       });
   });

  

   
</script>
@endsection

