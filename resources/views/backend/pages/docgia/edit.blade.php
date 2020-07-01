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
                {{ method_field('PUT') }}
                @csrf
               
                {{-- Nhap ten the loai --}}
                <div>
                    <label for="hoTen">Họ và tên</label>
                    <input type="text" class="form-control" required name="hoTen" id="hoTen"
                        placeholder="Tối đa 50 kí tự" value="{{$item->hoTen}}">
                </div>
                
                <div style="display: flex;">
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="namSinh">Năm sinh</label>
                <input type="text" class="form-control" value="{{$item->namSinh}}" required name="namSinh" id="namSinh">
                </div>



                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="namMat">Địa chỉ</label>
                    <input type="text" class="form-control"  name="diachi" id="diaChi"
                    placeholder="Tối đa 50 kí tự" value="{{$item->diaChi}}">
                </div>



                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="quocTich">Số điện thoại</label>
                    <input type="text" class="form-control"  name="sdt" id="sdt"
                    placeholder="Tối đa 11 kí tự" value="{{$item->sdt}}">
                </div>


                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="quocTich">Email</label>
                    <input type="text" class="form-control"  name="email" id="email"
                    placeholder="Tối đa 40 kí tự" value="{{$item->email}}">
                </div>
                
                
                
            </div>
                {{-- Bat Dau chon the loai cha--}}
                


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
        var href =   window.location;
        var id =href.toString().split('docgia/')[1].split('/')[0] ;
        if (hl) {
            thucHienAjax(id);
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
                maxlength: 50
            },
            tomTat: {
                required: true,
                minlength: 7,
                maxlength: 50
            },
            namSinh:{
                min:'1950',
                max: new Date().getFullYear(),
                digits:true,
                required:true
            },
           quocTich:{
            required: true,
                minlength: 7,
                maxlength: 50
           }

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
                maxlength: 'Tối đa 50 kí tự'
            },
            namSinh:{
                min:'Năm sinh quá lâu, chém gió à',
                max: 'Năm sinh lớn hươn hiện tại, chém gió à',
                required:'Không được bỏ trống',
                digits:"Dữ liệu không hợp lệ",
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
    function thucHienAjax(id) {
        var obj = {
            'hoTen': $("#hoTen").val(),
            'tomTat': $("#tomTat").val(),
            'namSinh': $("#namSinh").val(),
            'namMat': $("#namMat").val(),
            'quocTich': $("#quocTich").val(),
            // 'theLoai': $('input[name=theLoai]:checked').val(),
        
        };
        // var obj = $("#docgiaForm").serialize();
        console.log(obj);
        
        $.ajax({
            type: "post",
            method:'put',
            url: urlPost+'/'+id,
            data: obj,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                if (response.yes === true) {

                //    var now = new Date();
                //     $("#hoTen").val("");
                //     $("#namSinh").val( Date.now());
                //     $("#namMat").val(new Date (now.getTime()));
                //     $("#quocTic").val("");
                //     $("#tomTat").val("");

                    alertify.success('Sửa độc giả thành công');
                }
            }
        });
    }



</script>
@endsection