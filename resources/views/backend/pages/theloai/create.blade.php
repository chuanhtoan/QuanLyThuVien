@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
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

    .theLoai {
        padding-left: 1rem !important;
    }

    body {
        font-family: 'Muli', sans-serif;
    }

    .white-box label {
        font-weight: bold;
    }

    ul.theLoai{
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
            <form  id="theLoaiForm" action="{{route('theloai.store')}}"   method="post">
                @csrf
                {{-- Nhap ten the loai --}}
                <div>
                    <label for="tenThaLoai">Tên thể loại</label>
                    <input type="text" class="form-control" required name="tenTheLoai" id="tenTheLoai"
                        placeholder="VD: Sách,truyện,...">
                </div>

                {{-- Them mo ta ve the loai --}}
                <div style="margin-top: 2rem !important;">
                    <label for="mieuTa">Mô tả ngắn về thể loại</label>
                    <textarea class="form-control" name="mieuTa" required id="mieuTa" rows="4"></textarea>
                </div>

                {{-- Bat Dau chon the loai cha--}}

                <div class="cayTheLoai" style="margin-top: 2rem !important;">
                    <label class="font-muli">Chọn thể loại cha:
                   </label>
                    <div>

                        <label class="myRadio" for="theloai-none">
                            <input checked type="radio" style="display: contents;" value="0" name="theLoai" id="theloai-none">
                            <span class="custom-tick"></span>
                            <span>None</span>
                        </label>
                    </div>
                    <ul><li class=" nav-item" id="li-0" style="list-style: none;">
                    {!!$html!!}
                        </li>
                    </ul>
                    <div class="text-center" style="margin-top: 5rem;">
                        <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                        <button type="button" id = "check" class = "btn btn-primary">Lưu</button>
                        <a href="{{route('theloai.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>
    $("#check").click(function(){
        var hl = $("#theLoaiForm").valid();    
        if(hl){
            thucHienAjax();
        }
    });

    $("#theLoaiForm").validate({
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
            tenTheLoai: {
                required: true,
                minlength: 7,
                maxlength: 50
            },
            mieuTa: {
                required: true,
                minlength: 5,
                maxlength: 100
            },
           

        },
        messages: {
            tenTheLoai: {
                required: 'Bạn phải nhập trường này',
                minlength: "Tối thiểu 5 kí tự",
                maxlength: "Tối đa 100 kí tự"
            },
            mieuTa: {
                required: 'Bạn phải nhập trường này',
                minlength: "Tối thiểu 7 kí tự",
                maxlength: "Tối đa 50 kí tự"
            },
           

        }, errorPlacement: function (err, elemet) {
        
            err.insertAfter(elemet);    
            err.addClass('invalid-feedback d-inline text-danger');
            elemet.addClass('form-control is-invalid');
            $('.focus-input100-1,.focus-input100-2').addClass('hidden');
        }
    }
    );
    function thucHienAjax(form){
        var tag= "#li-"+$('input[name=theLoai]:checked').val(); 
        
        var html= $(""+tag).html();
        
        var obj = {
            'tenTheLoai':$("#tenTheLoai").val(),
            'mieuTa': $("#mieuTa").val(),
            'theLoai':$('input[name=theLoai]:checked').val(),
        };
        var url = '/admin/danhmuc/theloai';
        console.log(url);
        $.ajax({
            type:"post",
            url: url,
            data:obj,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response){
                
                if(response.yes === true){
                    
                html+=response.result;
                $(""+tag).html(html) ;
        
                $("#theloai-none").prop("checked",true);
                $("#tenTheLoai").val("") ;
                $("#mieuTa").val("") ;

                alertify.success('Thêm thể loại thành công');
            }
        }
    });
    }

    

</script>
@endsection