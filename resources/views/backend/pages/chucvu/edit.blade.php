@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
   body {
        font-family: 'Muli', sans-serif;
    }

    /* .white-box label {
        font-weight: bold;
    } */

    ul.theLoai {
        border-left: 0.5px solid black;
    }

    .white-box {
     
        position: relative;
    }

    .box-title {
        display: flex;
        /* position: absolute; */
        top: 0;
        font-family: 'Roboto', sans-serif;

    }
    .box-title label.error{
        text-transform: capitalize !important;
        font-size: 1.1rem !important;
    }
    .box-title label.title{
        text-transform: capitalize !important;
        font-size: 1.5rem !important;
    }

    .fixed {
        width: 70%;
        position: fixed;

    }

    /* CUSTOM RADIO */
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

    .myRadio input[type=checkbox]:checked~.custom-tick:before,
    .myRadio input[type=checkbox]:checked~.custom-tick:after {
        height: 4px;
        display: inline-block;
        border-radius: 0;
    }

    .myRadio input[type=checkbox]:checked~.custom-tick:before {
        width: 9px;
        background-color: rgb(3, 43, 19);
        border: none;
        top: 8px;
        transform: rotate(40deg);
        left: 2px;
    }

    .myRadio input[type=checkbox]:checked~.custom-tick:after {
        width: 18px;
        background-color: rgb(12, 172, 78);
        transform: rotateZ(130deg);
        top: 7px;
        left: 7px;
    }

    .myRadio span {
        margin-left: 1.5rem;
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
                {{ method_field('PUT') }}
                @csrf

                {{-- Nhap ten chuc vu --}}
                <div class="box-title">
                    <div style="width: 49% ;margin-right: 10px">
                        <label class="title" for="tenChucVu">Tên chúc vụ:</label>
                        <input type="text" class="form-control" required name="tenChucVu" id="tenChucVu"
                            placeholder="Tối đa 50 kí tự" value="{{$cv->tenChucVu}}">
                    </div>

                    <div style="width: 49%">
                        <label class="title" for="tenQuyen">Lọc kết quả:</label>
                        <input type="text" class="form-control" name="tenQuyen" id="tenQuyen"
                            placeholder="Tên quyền">


                    </div>

                </div>

                <div id="danh-sach-quyen">
                    <div style="margin-bottom: 3rem;">
                        Danh sách các quyền:
                    </div>
                    @foreach ($item as $q)
                    <div class="du-lieu">

                        {{-- trinh bay mot quyen --}}
                        <label class="myRadio" for="tenq-{{$q->id}}">
                            <input 
                                @foreach ($cv->quyens()->get() as $q_)
                                    @if ($q_->id == $q->id)
                                        checked
                                        @break
                                    @endif 
                                @endforeach
                            type="checkbox" style="display: contents;" value="{{$q->id}}" name="tenq-{{$q->id}}" id="tenq-{{$q->id}}">
                            <span class="custom-tick"></span>
                            {{-- Cai nay the hien ten quyen --}}
                            <span class="text">{{$q->tenQuyen}}</span>
                            {{-- Dang dinh them mo ta cac kiey phia sau no --}}
                        </label>
                    </div>
                    @endforeach
                </div>
               
                <div class="text-center" style="margin-top: 5rem;">
                    <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                    <button type="button" id="check" class="btn btn-primary">Lưu</button>
                    <a href="{{route('chucvu.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost = '/admin/danhmuc/chucvu';
    $("#check").click(function () {
        var hl = $("#tacgiaForm").valid();
        var href = window.location;
        var id = href.toString().split('chucvu/')[1].split('/')[0];
        if (hl) {
            console.log('OK');
            thucHienAjax(id);
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
            tenChucVu: {
                required: true,
                minlength: 7,
                maxlength: 50
            },

        },
        messages: {
            tenChucVu: {
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
        var checkboxs = $('.myRadio input[type=checkbox]:checked');
        var quyens = new Array();
        for(let i =0;i<checkboxs.length;i++){
            console.log("C");
            quyens.push($(checkboxs[i]).val());
        }
        var obj = {
            'tenChucVu': $("#tenChucVu").val(),
            'chucVu': quyens,

        };
        // var obj = $("#tacgiaForm").serialize();
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

                if (response.yes != '') {
                    alertify.success('Sửa chức vụ thành công');
                }
            }
        });
    }

    const offsetBoxTitle = $('.bg-title').offset().top;


    // ===================== PHAN CAI DAT STICKY CHO BOX-TITLE =====================
    // $(window).scroll(function (e) {
    //     if (window.pageYOffset >= offsetBoxTitle) {
    //         $('.box-title').addClass('fixed');
    //         $('.box-title').css({ 'top': offsetBoxTitle + "px", 'background-color': 'white' });
    //         // console.log('OK');

    //     } else
    //         $('.box-title').removeClass('fixed');
    //     // console.log('NO');


    // });


    // =================== CHUC NANG TIEM KIEM ======================
    $('#tenQuyen').on('blur', function () {
        let timKiem = $(this).val().toString().toUpperCase();
        let mang = $('#danh-sach-quyen .myRadio');
        for (let i = 0; i < mang.length; ++i) {
            console.log($(mang[i]).children('.text').text());
            $(mang[i]).parent().toggle($(mang[i]).children('.text').text().toUpperCase().indexOf(timKiem) >-1);
        }

    });


</script>
@endsection