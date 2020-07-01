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

    .theLoai {
        padding-left: 1rem !important;
    }

    .text-title {
        text-transform: uppercase;
        font-weight: bold;
        display: inline-block;
        margin-right: 0.5rem;
        color: black;
    }

    /* CUSTOM CHECBOX */

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
        @include('backend.pages.sach.page-title')

        <div class="white-box">
             @isset($update)
             <div style="color:#c42214;font-size: 2rem; font-weight: bolder; text-align: center;">Cập nhật dữ liệu thành công</div>

             @endisset
            <form id="sachForm" action="{{route('sach.update',$sach->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div>
                    <label for="tenSach">Tên Sách</label>
                    <input type="text" class="form-control" value="{{$sach->tenSach}}" required name="tenSach" id="tenSach"
                        placeholder="Tối đa 50 kí tu">
                </div>
                {{-- Nhap ten the loai --}}
                <div class="row">

                    <div class="col-sm-6">
                        <label>Tác Giả</label>
                        <select name="tacgia" class="form-control" id="tacgia">
                            @foreach ($tacgia as $item)
                            <option @if($item->id == $sach->ID_TacGia)
                                checked 
                                @endif value="{{$item->id}}">{{$item->hoTen}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label>Nhà Xuất Bản</label>
                        <select name="nxb" class="form-control" id="nxb">
                            @foreach ($nxb as $item)
                            <option @if($item->id == $sach->ID_NXB)
                                    checked 
                                    @endif
                                value="{{$item->id}}">{{$item->tenNXB}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Thể loại</label>
                        <select name="theLoai" class="form-control" id="theLoai">
                            @foreach ($theloai as $item)
                            <option 
                                    @if($item->id == $sach->ID_TheLoai)
                                       checked 
                                    @endif
                            value="{{$item->id}}">{{$item->tenTheLoai}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <p style="font-weight: bold;">Cho mượn không:</p>
                        <div style="display: inline-block;margin-right:1rem;">
                            <label class="myRadio" for="theloai-cho">
                                <input checked type="radio" 
                                   @if($sach->duocPhepMuon)
                                       checked 
                                   @endif
                                    style="display: contents;" value="1" id="theloai-cho"
                                    name="choMuon">
                                <span class="custom-tick"></span>
                                <span>Cho mượn</span>
                        </div>
                        <div style="display: inline-block;">
                            </label>
                            <label class="myRadio" for="theloai-chua">
                                <input type="radio" style="display: contents;" value="0" id="theloai-chua"
                                  @if(!$sach->duocPhepMuon)
                                   checked 
                                   @endif
                                    name="choMuon">
                                <span class="custom-tick"></span>
                                <span>Chưa cho mượn</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="namxb">Năm xuất bản</label>
                        <input type="text" class="form-control" required name="namxb" id="namxb"
                            placeholder="Tối đa 50 kí tu">
                    </div>
                    <div class="col-sm-4">
                        <label for="gia">Giá cuốn sách</label>
                        <input type="text" class="form-control" required name="gia" id="gia">
                    </div>
                    <div class="col-sm-4">
                        <label for="vietTat">Tên viết tắt</label>
                        <input type="text" class="form-control" required name="vietTat" id="vietTat">
                    </div>
                </div>


                <div class="form-cotrol" style="display: contents;">
                    <label class="form-cotrol">Ảnh bìa</label>
                    <input type="file" class="form-cotrol" style=" border: none;background:none;" name="anhbia"
                     id="anhbia">
                    <img class="form-cotrol" src="@if ($sach->anhBia) {{asset('img/bia/')}}/{{ $sach->anhBia}}
                                                  @endif " 
                    id="bia">
                </div>
                {{-- Bat Dau chon the loai cha--}}



                <div class="text-center" style="margin-top: 5rem;">
                    <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                    <button type="button" id="check" class="btn btn-primary">Lưu</button>
                    <a href="{{route('sach.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>
    // $(document).ready(
    //     function(e){
    //         if($('#sachForm img').attr('src') != ''){
    //             var path = $('bia').attr('src')+"";
    //             path= path.split('upload')[1];
    //              console.log($('#anhbia').val());
    //         }
    //     }
    // );
    $("#anhbia").on('change', function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                $("#bia").attr('src',fr.result) ;

                
            }
            fr.readAsDataURL(files[0]);
        }


    });



    // ===================  VALIDATE CAC TRUONG CO TRONG FORM========================
    const urlPost = '/admin/danhmuc/sach/';
    $("#check").click(function () {
        // console.log();
        var hl = $("#sachForm").valid();
        var href =   window.location+"";
        var id =href.toString().split('sach/')[1].split('/')[0] ;
        if (hl) {
            console.log($("#ID_TacGia").val());
            $('#sachForm').submit();
            // thucHienAjax(id);
        }
    });





    $("#sachForm").validate({
        onfocusout: function (element) {
            if ($(element).val() == "") return;
            var hl = $(element).valid();
            // console.log(hl);
        
            if (hl) {
                
                if ($(element).hasClass('is-invalid'))
                    $(element).removeClass("form-control is-invalid");
                $(element).addClass('form-control is-valid');
            }
        }, onkeyup: false,
        rules: {
            'tenSach': {
                'required': true,
                'minlength': 7,
                maxlength: 50
            },
            namxb: {
                required: true,
                digits: true,
                min: '1970',
                max: '' + new Date().getFullYear()
            }, gia: {
                required: true,
                digits: true
            },
            vietTat: {
                required: true,
            },

        },
        messages: {
            'tenSach': {
                'required': 'Bạn phải nhập trường này',
                minlength: "Tối thiểu 7 kí tự",
                maxlength: "Tối đa 50 kí tự",
                kiemTraDL: 'Tac gia không có dữ liệu',
            },
           
            namxb: {
                required: 'Không được bỏ trống',
                digits: 'Không hợp lệ',
                min: 'Năm xuất bản lâu thế,chém gió à',
                max: 'Quá năm hiện tại, đi trước thời đại???'
            }, gia: {
                required: 'Không được bỏ trống',
                digits: 'Không hợp lệ'
            },
            vietTat: {
                required: 'Không được bỏ trống',
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
        // var obj = {
        //     'tenSach': $("#tenSach").val(),
        //     'ID_TacGia':  $('#tacgia').children('option:selected').val(),
        //     'ID_TheLoai': $('#theLoai').children('option:selected').val(),
        //     'ID_NXB': $('#nxb').children('option:selected').val(),
        //     'namXB': $("#namxb").val(),
        //     'duocPhepMuon': $("input[name=choMuon]:checked").val(),
        //     'gia': $("#gia").val(),
        //     'anhBia': $("#anhbia").val(),

        //     // 'theLoai': $('input[name=theLoai]:checked').val(),

        // };

        var form = new FormData();
        form.append('anhbia',$("#anhbia").prop('files')[0]);
        form.append('tenSach',$("#tenSach").val());
        form.append('ID_TacGia',$('#tacgia').children('option:selected').val());
        form.append('ID_TheLoai',$('#theLoai').children('option:selected').val());
        form.append('ID_NXB',  $('#nxb').children('option:selected').val());
        form.append('namXB', $("#namxb").val());
        form.append('duocPhepMuon', $("input[name=choMuon]:checked").val());
        form.append('gia',  $("#gia").val());
        form.append('vietTat',  $("#vietTat").val());

        // var obj = $("#tacgiaForm").serialize();
        // var form = new FormData($('#sachForm')[0]);
        //  var formData = new FormData(form);
        console.log(form==null);
        $.ajaxSetup({
           
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
           
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form,
            type: 'put',
            url:urlPost+id,
            async:false,
            success: function (response) {
                console.log(response);
                if (response != "") {
                     alertify.success('Sua sach thành công');
                }
            }
        });
    }

</script>
@endsection