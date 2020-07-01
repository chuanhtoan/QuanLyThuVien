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
                <h4 class="page-title">Sach/The Loai</h4>
            </div>
        </div>

        <div class="white-box">
            <form id="tacgiaForm" action="{{route('tacgia.store')}}" method="post">
                @csrf
                {{-- Nhap ten the loai --}}
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
                    <label for="namMat">Năm mất</label>
                    <input type="text" class="form-control"  name="namMat" id="namMat">
                </div>



                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="quocTich">Quốc tịch</label>
                    <input type="text" class="form-control"  name="quocTich" id="quocTich"
                    placeholder="Tối đa 20 kí tự">
                </div>
            </div>
                {{-- Them mo ta ve the loai --}}
                <div style="margin-top: 2rem !important;">
                    <label for="tomTat">Tóm tắt về tác giả</label>
                    <textarea class="form-control" name="tomTat" required id="tomTat" rows="4"
                    placeholder="Tối đa 500 kí tự"></textarea>
                </div>

                {{-- Bat Dau chon the loai cha--}}
                


                <div class="text-center" style="margin-top: 5rem;">
                    <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                    <button type="button" id="check" class="btn btn-primary">Lưu</button>
                    <a href="{{route('tacgia.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost='/admin/danhmuc/tacgia';
    $("#check").click(function () {
        var hl = $("#tacgiaForm").valid();
        if (hl) {
            thucHienAjax($("#tacgiaForm"));
        }
    });

    $("#tacgiaForm").validate({
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
            tomTat: {
                required: true,
                minlength: 7,
                maxlength: 500
            },
            namSinh:{
                digits : true,
                min:'1950',
                max: new Date().getFullYear(),
                required:true,
               
            },
            namMat: {digits:true},
            quocTich:{
            required: true,
                minlength: 7,
                maxlength: 50
           },

        },
        messages: {
            hoTen: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 50 kí tự'
            },
            tomTat: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 500 kí tự'
            },
            namSinh:{
                min:'Năm sinh quá lâu, chém gió à',
                max: 'Năm sinh lớn hơn hiện tại, chém gió à',
                digits: 'Năm sinh ko hợp lệ',
                required:'Không được bỏ trống'
            },
            namMat:{
                digits: 'Năm sinh ko hợp lệ',
            },
            quocTich:{
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 50 kí tự'
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
            'tomTat': $("#tomTat").val(),
            'namSinh': $("#namSinh").val(),
            'namMat': $("#namMat").val(),
            'quocTich': $("#quocTich").val(),
            // 'theLoai': $('input[name=theLoai]:checked').val(),
        
        };
        // var obj = $("#tacgiaForm").serialize();
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
                    $("#namSinh").val( '');
                    $("#namMat").val('');
                    $("#quocTic").val("");
                    $("#tomTat").val("");

                    alertify.success('Thêm thể loại thành công');
                }
            }
        });
    }



</script>
@endsection