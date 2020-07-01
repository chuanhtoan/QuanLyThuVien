@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    /* CUSTOM CHECBOX */
    .myRadio input[type=radio] {
        opacity: 0;
    }

    .myRadio {
        position: relative;
    }

    .myRadio .custom-tick:before {
        border: 2px black solid;
        border-radius: 50%;
        width: 14px;
        height: 14px;
        content: "";
        display: inline-block !important;
        position: absolute;
        top: 50%;
        transform: translateY(-45%);
        left: 0;
        transition: all .4s;
    }

    .myRadio .custom-tick:after {
        content: "";
        display: inline-block !important;
        position: absolute;
        display: none;
        left: 0;
        transition: all .4s;
    }

    .myRadio input[type=radio]:checked~.custom-tick:before,
    .myRadio input[type=radio]:checked~.custom-tick:after {
        height: 4px;
        display: inline-block;
        border-radius: 0;
    }

    .myRadio input[type=radio]:checked~.custom-tick:before {
        width: 9px;
        background-color: rgb(3, 43, 19);
        border: none;
        top: 8px;
        transform: rotate(40deg);
        left: 2px;
    }

    .myRadio input[type=radio]:checked~.custom-tick:after {
        width: 18px;
        background-color: rgb(12, 172, 78);
        transform: rotateZ(130deg);
        top: 7px;
        left: 7px;
    }

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

    #nhanvienForm input{
        border: none;
        box-shadow: none;
        border-bottom: solid 0.7px rgb(179, 179, 179);
    }
    #nhanvienForm input:read-only{
      background-color: white;
    }


    .avatar {
        position: relative;

    }

    .avatar img {
        display: block;
        width: 75%;
        /* border-radius: 50%; */
        margin: 0 auto;
       
    }

    .avatar input[type=file] {
        opacity: 0;
        z-index: -1;
        position: absolute;
    }

    .avatar button {
        display: none;
    }
    .avatar label{
        display: block;text-align: center; font-weight: 800;font-size: 1.5rem;
    }

</style>
@endsection
{{-- {{$html}} --}}

@section('noi-dung')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Nhan Vien</h4>
            </div>
        </div>

        <div class="white-box" style="overflow: hidden;">
            <form id="nhanvienForm" action="{{route('nhanvien.store')}}" method="post">
                {{ method_field('PUT') }}
                @csrf
                <div class="col-md-8">
                    {{-- Nhap ten the loai --}}
                    <div>
                        <label for="hoTen">Họ và tên</label>
                        <input type="text" class="form-control" required name="hoTen" id="hoTen"
                            placeholder="Tối đa 50 kí tự" value="{{$item->hoTen}}">
                    </div>



                    <div style="margin-top:2rem ;margin-right:1rem ;">
                        <label for="chucVu">Chức vụ</label>
                        <input type="text" class="form-control" value="{{$item->chucVu}}" name="chucVu" id="chucVu"
                            placeholder="Tối đa 30 kí tự">
                    </div>



                    <div style="margin-top:2rem ;margin-right:1rem ;">
                        <label for="namSinh">Năm sinh</label>
                        <input type="text" class="form-control" value="{{$item->namSinh}}" required name="namSinh"
                            id="namSinh">
                    </div>


                    <div style="margin-top:2rem ;margin-right:1rem ;">
                        <label for="namMat">CMND</label>
                        <input type="text" class="form-control" value="{{$item->cmnd}}" name="cmnd" id="cmnd"
                            placeholder="Tối đa 30 kí tự">
                    </div>



                    <div style="margin-top:2rem ;margin-right:1rem ;">
                        <label for="namMat">Địa chỉ</label>
                        <input type="text" class="form-control" name="diaChi" id="diaChi" placeholder="Tối đa 50 kí tự"
                            value="{{$item->diaChi}}">
                    </div>



                    <div style="margin-top:2rem ;margin-right:1rem ;">
                        <label for="quocTich">Số điện thoại</label>
                        <input type="text" class="form-control" name="sdt" id="sdt" placeholder="Tối đa 11 kí tự"
                            value="{{$item->sdt}}">
                    </div>


                    <div>
                        <p style="font-weight: bold;">Giới tính:</p>
                        <div style="display: inline-block;margin-right:1rem;">
                            <label class="myRadio" for="theloai-cho">
                                <input @if ($item->gioiTinh == true)
                                       checked
                                       @endif 
                                    type="radio" style="display: contents;" value="1" id="theloai-cho"
                                    name="gioitinh">
                                <span class="custom-tick"></span>
                                <span>Nam</span>
                        </div>
                        <div style="display: inline-block;">
                            </label>
                            <label class="myRadio" for="theloai-chua">
                                <input 
                                      @if ($item->gioiTinh != true)
                                          checked
                                       @endif
                                    type="radio" style="display: contents;" value="0" id="theloai-chua"
                                    name="gioitinh">
                                <span class="custom-tick"></span>
                                <span>Nữ</span>
                            </label>
                        </div>

                    </div>
                  
                   
                </div>
                <div class="col-md-4">
                    <div class="avatar ">
                        <label>Ảnh chân dung</label>
                        <img src="{{asset('img/avatar/nhanvien/'.$item->anhChanDung)}}" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>
    function choPhepNhap(choPhep){
        $('#nhanvienForm input').prop('readonly',!choPhep);
        $('#nhanvienForm input[type=radio]').prop('disabled',true);
    }    
    const urlPost = '/admin/danhmuc/nhanvien';
    $(document).ready(function (e) {
        choPhepNhap(false);   
    }
    );

</script>
@endsection