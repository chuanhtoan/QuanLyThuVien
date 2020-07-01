@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
 

    body {
        font-family: 'Muli', sans-serif;
    }

    .white-box label {
        font-weight: bold;
    }

    ul.theLoai {
        border-left: 0.5px solid black;
    }
</style>
@endsection
{{-- {{$html}} --}}

@section('noi-dung')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Doc Gia</h4>
            </div>
        </div>

        <div class="white-box">
            <form id="docgiaForm" action="{{route('docgia.store')}}" method="post">
                @csrf
                {{-- Nhap ten doc gia --}}
                <div>
                    <label for="hoTen">Họ và tên</label>
                    <input type="text" class="form-control" required name="hoTen" id="hoTen"
                        placeholder="Tối đa 50 kí tự">
                </div>
                
                <div style="display: flex;">
                
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="namSinh">Năm sinh</label>
                    <input type="text" class="form-control" required name="namSinh" id="namSinh">
                </div>
                
                
                
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="namMat">Địa chỉ</label>
                    <input type="text" class="form-control"  name="diachi" id="diaChi"
                    placeholder="Tối đa 50 kí tự">
                </div>



                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="quocTich">Số điện thoại</label>
                    <input type="text" class="form-control"  name="sdt" id="sdt"
                    placeholder="Tối đa 11 kí tự">
                </div>


                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="quocTich">Email</label>
                    <input type="text" class="form-control"  name="email" id="email"
                    placeholder="Tối đa 40 kí tự">
                </div>
            </div>

            <div class="text-center" style="margin-top: 5rem;">
                <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                <button type="button" id="check" class="btn btn-primary">Lưu</button>
                <a href="{{route('docgia.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
            </div>


            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost='/admin/danhmuc/docgia';
    $("#check").click(function () {
        var hl = $("#docgiaForm").valid();
        if (hl) {
            thucHienAjax($("#docgiaForm"));
        }
    });

    $("#docgiaForm").validate({
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
                minlength: 7,
                maxlength: 50,
                
            },
            namSinh:{
                min:'1950',
                max: new Date().getFullYear(),
                digits:true,
                required:true
            },
            diachi: {
                required: true,
                minlength: 1,
                maxlength: 50
            },
           sdt:{
            required: true,
                minlength: 7,
                maxlength: 11
           },
           email:{
            required: true,
                minlength: 1,
                maxlength: 40
           },
        },
        messages: {
            hoTen: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 50 kí tự'
            },
            namSinh:{
                min:'Năm sinh quá lâu, chém gió à',
                max: 'Năm sinh lớn hơn hiện tại, chém gió à',
                required:'Không được bỏ trống',
                digits:"Dữ liệu không hợp lệ",
            },
            diachi:{
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 1 kí tự',
                maxlength: 'Tối đa 50 kí tự'
           },
            sdt: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 11 kí tự'
            },
            email:{
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
    function thucHienAjax(form) {
        var obj = {
            'hoTen': $("#hoTen").val(),
            'namSinh': $("#namSinh").val(),
            'diaChi': $("#diaChi").val(),
            'sdt': $("#sdt").val(),
            'email': $("#email").val(),
            // 'theLoai': $('input[name=theLoai]:checked').val(),
        
        };
        // var obj = $("#docgiaForm").serialize();
        console.log(obj);
        
        $.ajax({
            type: "post",
            url: urlPost,
            data: obj,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                if (response.yes === true) {

                   var now = new Date();
                    $("#hoTen").val("");
                    $("#namSinh").val('');
                    $("#diaChi").val("");
                    $("#sdt").val("");
                    $("#email").val("");

                    alertify.success('Thêm độc giả thành công');
                }
            }
        });
    }



</script>
@endsection