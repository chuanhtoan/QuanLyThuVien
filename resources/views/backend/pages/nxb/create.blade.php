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
            <form id="tacgiaForm" action="{{route('nxb.store')}}" method="post">
                {{-- {{ method_field('PUT') }} --}}
                @csrf
               
                {{-- Nhap ten the loai --}}
                <div>
                    <label for="tenNXB">Tên nhà xuất bản</label>
                    <input type="text" class="form-control" required name="tenNXB" id="tenNXB"
                        placeholder="Tối đa 50 kí tu">
                </div>
                
                <div style="display: flex;">
                
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="email">Email:</label>
                <input type="text" class="form-control"  required name="email" id="email">
                </div>
                
                
                
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="sdt">Số điện thoại</label>
                    <input type="text" class="form-control"   name="sdt" id="sdt">
                </div>



               

                {{-- Bat Dau chon the loai cha--}}
                


                <div class="text-center" style="margin-top: 5rem;">
                    <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                    <button type="button" id="check" class="btn btn-primary">Lưu</button>
                    <a href="{{route('nxb.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost='/admin/danhmuc/nxb';
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
            tenNXB: {
                required: true,
                maxlength: 50
            },
            email: {
                required: true,
                maxlength: 100,
                email:true
            },
            sdt:{
                required: true,
                maxlength: 20
            }


        },
        messages: {
            tenNXB: {
                required: 'Bạn phải nhập trường này',
                maxlength: "Tối đa 50 kí tự"
            },
            email: {
                required: 'Bạn phải nhập trường này',
                maxlength: "Tối đa 100 kí tự",
                email:'Không đúng định dạng'
            },
            sdt:{
                required: 'Bạn phải nhập trường này',
                maxlength: "Tối đa 20 kí tự"
            }


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
            'tenNXB': $("#tenNXB").val(),
            'email': $("#email").val(),
            'sdt': $("#sdt").val(),
            
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
                console.log(response);
                if (response.yes === true) {

                    $("#tenNXB").val(''),
                    $("#email").val(''),
                    $("#sdt").val(''),

                    alertify.success('Thêm thể loại thành công');
                }
            }
        });
    }



</script>
@endsection