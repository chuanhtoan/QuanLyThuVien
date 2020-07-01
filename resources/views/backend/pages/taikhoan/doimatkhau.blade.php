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
               <form id="form">
                <div style="width: 50%; margin: 0 auto;"> 
                    <div style="margin-top:2rem ;margin-right:1rem ; display: flex;">
                        <label style="width: 30%" for="matKhau">Nhập mật khẩu</label>
                        <input style="width: 50%" type="password" name="matKhau" id="matKhau">
                    </div>

                    <div style="margin-top:2rem ;margin-right:1rem ; display: flex;">
                        <label style="width: 30%" for="laiMatKhau">Nhập lại mật khẩu</label>
                        <input style="width: 50%" type="password" name="laiMatKhau" id="laiMatKhau">
                    </div>

                    <div style=" width: 50%; margin: 3rem auto 0 auto;">
                        <button type="button" value="{{Auth::guard('admin')->user()->id}}" class="OK btn btn-primary">OK</button>
                        <a href="{{route('sach.index')}}"><button type="button" class="Cancel btn btn-danger">Cancel</button></a>
                    </div>
                </div>
                </form>
            </div>

        </div>
    </div>

</div>

@endsection
@section('footer')
@parent
<script>
  

$('.OK').click(function(){
    
     var hl = $('#form').valid();
     if(hl){

          DoiMatKhau();

     }

});
function DoiMatKhau(){
   
     $.ajax({
         type: "post",
         url: "/admin/danhmuc/taikhoan/doimatkhau/"+ $('.OK').val(),
         data: {matKhau: $('#matKhau').val()},
         async:false,
         headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
         success: function (response) {
             if(response['yes']==true){
                 alertify.success('Đôi mật khẩu thành công');
                 setTimeout(
                     ()=>{window.location = "{{route('admin.login')}}"  ;},
                     1000
                 );
                 
             }
         }
     });        
}



$("#form").validate({
    onfocusout: function (element) {
        if ($(element).val() == "") return;
        var hl = $(element).valid();
        console.log(hl);
        if (hl) {

            if ($(element).hasClass('is-invalid'))
                $(element).removeClass("form-control is-invalid");
            $(element).addClass('form-control is-valid');
        }
    }, onkeyup: false,
    rules: {
       
        matKhau: {
            required: true,
            minlength: 5
        },
        laiMatKhau: {
            required: true,
            equalTo: "#matKhau"
        },
        
    },
    messages: {
        matKhau: {
            required: "Nhập tên mật khẩu",
            minlength: "Mật khẩu tối thiểu 5 kí tự",
        },
        laiMatKhau: {
            required: "Không được bỏ trống",
            equalTo: "Không đúng mật khẩu"
        }
    },
    errorPlacement: function (err, elemet) {
        err.insertBefore(elemet);
        err.addClass('invalid-feedback');
        elemet.addClass('form-control is-invalid');
        elemet.parent().addClass('border-0');
        $('.focus-input100-1,.focus-input100-2').addClass('hidden');
    }
 } );
   
</script>
@endsection

