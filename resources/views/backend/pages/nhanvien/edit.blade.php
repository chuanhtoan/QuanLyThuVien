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
                                <input  type="radio" style="display: contents;" value="1" id="theloai-cho"
                                   @if ($item->gioiTinh == true)
                                      checked 
                                   @endif    
                                name="gioitinh">
                                <span class="custom-tick"></span>
                                <span>Nam</span>
                        </div>
                        <div style="display: inline-block;">
                            </label>
                            <label class="myRadio" for="theloai-chua">
                                <input  type="radio" style="display: contents;" value="0" id="theloai-chua"
                                @if ($item->gioiTinh == false)
                                      checked 
                                   @endif      
                                name="gioitinh">
                                <span class="custom-tick"></span>
                                <span>Nữ</span>
                            </label>
                        </div>

                    </div>





                    {{-- Bat Dau chon the loai cha--}}

                    <div class="text-center" style="margin-top: 5rem;">
                        <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                        <button  type="button" id="check" class="btn btn-primary">Lưu</button>
                        <button  type="button"  class=" sua btn  btn-info">Sửa</button>
                        <a href="{{route('nhanvien.index')}}"> <button type="button"
                                class="btn btn-danger">Hủy</button></a>
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
    }    
    const urlPost = '/admin/danhmuc/nhanvien';
    $(document).ready(function (e) {
        choPhepNhap(false);   
    }
    );

  
    $("#check").click(function () {
        var hl = $("#nhanvienForm").valid();
        var href = window.location;
        var id = href.toString().split('nhanvien/')[1].split('/')[0];
        if (hl) {
            thucHienAjax(id);
        }
    });

    $('#nhanvienForm .sua').click(function(){
        $(this).removeClass('sua');
        choPhepNhap(true);
        $(this).text('Reset');
        $(this).prop('type','reset');
        $(this).addClass('reset');
    });

    $("#nhanvienForm").validate({
        onfocusout: function (element) {
            if ($(element).val() == "") return;
            var hl = $(element).valid();
            if (hl) {

                if ($(element).hasClass('is-invalid'))
                    $(element).removeClass("form-control is-invalid");
                $(element).addClass('form-control is-valid');
            }
        }, onkeyup: false,
        rules: {
            hoTen: {
                required: true,
                // minlength: 7,
                maxlength: 50,

            },
            chucVu: {
                required: true,
                minlength: 3,
                maxlength: 30,

            },
            namSinh: {
                min: '1950',
                max: '2020',
                required: true
            },
            cmnd: {
                required: true,
                minlength: 6,
                maxlength: 30
            },
            diaChi: {
                required: true,
                minlength: 1,
                maxlength: 50
            },
            sdt: {
                required: true,
                minlength: 7,
                maxlength: 11
            },
            email: {
                required: true,
                minlength: 1,
                maxlength: 50
            },
        },
        messages: {
            hoTen: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 50 kí tự'
            },
            chucvu: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 3 kí tự',
                maxlength: 'Tối đa 30 kí tự'
            },
            namSinh: {
                min: 'Năm sinh quá lâu, chém gió à',
                max: 'Năm sinh lớn hơn hiện tại, chém gió à',
                required: 'Không được bỏ trống'
            },
            cmnd: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 6 kí tự',
                maxlength: 'Tối đa 30 kí tự'
            },
            diaChi: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 1 kí tự',
                maxlength: 'Tối đa 50 kí tự'
            },
            sdt: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 11 kí tự'
            },
            email: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 1 kí tự',
                maxlength: 'Tối đa 40 kí tự'
            },
        }, errorPlacement: function (err, elemet) {

            err.insertAfter(elemet);
            err.addClass('invalid-feedback d-inline text-danger');
            elemet.addClass('form-control is-invalid');
            $('.focus-input100-1,.focus-input100-2').addClass('hidden');
        }
    }
    );
    function thucHienAjax(id) {
        var obj = {
            'hoTen': $("#hoTen").val(),
            'chucVu': $("#chucVu").val(),
            'namSinh': $("#namSinh").val(),
            'cmnd': $("#cmnd").val(),
            'diaChi': $("#diaChi").val(),
            'sdt': $("#sdt").val(),
            'gioiTinh' :$("input[name=gioitinh]:checked").val(),
         

        };
        // var obj = $("#nhanvienForm").serialize();
        console.log(obj);

        $.ajax({
            type: "post",
            method: 'put',
            url: urlPost + '/' + id,
            data: obj,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                if (response.yes === true) {
                    alertify.success('Sửa nhân viên thành công');
                }
            }
        });
    }



</script>
@endsection