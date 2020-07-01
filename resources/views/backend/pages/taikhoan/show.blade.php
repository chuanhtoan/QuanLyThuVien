@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    /* .white-box {
        font-family: 'Fira Sans', sans-serif;
    } */

    .table thead th {
        /* font-family: 'Noto Serif', serif; */
        font-family: 'Fira Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: bolder;
    }

    .gia-tri-thuoc-tinh {
        display: inline;
        padding-left: 3rem;
    }

    .ten-thuoc-tinh {
        text-align: end;
        width: 100px;
        display: inline-block;


    }

    /* .table-info{
        width: 70%;
    } */

    .table-info tr {
        display: block;
        margin-top: 2.5rem;
    }

    .avatar {
        position: relative;

    }

    .avatar img {
        display: block;
        margin: 0;
        width: 75%;
        border-radius: 50%;
        margin: 0 auto;
        margin-bottom: 1rem;
    }

    .avatar input[type=file] {
        opacity: 0;
        z-index: -1;
        position: absolute;
    }

    .avatar button {
        display: none;
    }

    .label-title{
        padding-bottom: 2rem; display: block ;border-bottom:0.7px solid rgb(187, 187, 187) ;
        font-family: 'Noto Serif', serif;
        font-size: 2rem;
    }
    .danh-sach-quyen{
        font-family: 'Roboto', sans-serif;
        font-weight: bolder;
    }
    .danh-sach-quyen li{
        padding-left: 1rem;
        margin-top: 1rem;
    }
    .danh-sach-quyen li span{
        margin-left: 1rem;
    }
    .ten-quyen{
        background-color: #2cca79;
        /* background-color: rgb(153, 153, 238); */
        padding:  0.5rem;
        border-radius: 4px;
    }
    .danh-sach-quyen p{
        font-family: 'Noto Serif', serif;
        margin-top: 1rem;
    }
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

                <div class="row" style="margin-bottom: 9rem;">
                    <div class="col-md-8">

                        <table class="table-info ">
                            <label class="label-title">Thông tin tài khoản</label>
                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>ID tài khoản: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span id="idTK">{{$data->id}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>Tên tài khoản: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span>{{$data->tenTaiKhoan}}</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>Email: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span>{{$data->email}}</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>Ngày lập: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span>{{ $data->ngayLap->format('d/m/Y')}}</span>
                                </td>
                            </tr>

                        </table>
                        
                    </div>
                    <div class="col-md-4">
                        <form method="post" action="{{route('taikhoan.avatar',$data->id)}}" id='form-avatar'
                            enctype="multipart/form-data" style="margin-bottom: 4rem;">
                            @csrf
                            <div class="avatar">
                                <img src="{{asset('img/avatar/admin/'.$data->avatar)}}" />
                                <label for="photo" class="btn btn-primary">Chọn file</label>
                                <input type="file" id="photo" name="photo" accept="image/*" />
                                <button class=" btn btn-success ">Lưu</button>
                            </div>
                        </form>

                        <div style="display: flex" >
                            <a class="btn btn-danger" style="margin-right: 2rem;">Cập nhật Email</a>
                            <a class="btn btn-info" href="{{route('taikhoan.mail',['id'=>Auth::guard('admin')->user()->id])}}">Đổi mật khẩu</a>
                            
                         </div>
                    </div>

                    
                </div>

                <div class="row" style="margin-bottom: 5rem !important; ">
                    
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <label class="label-title">Quyền của tài khoản</label>
                        <div class = "table-info quyen">
                           <ul class="danh-sach-quyen">
                               @foreach ($data->chucvus()->get() as $item)
                                    <p>Quyền: {{$item->tenChucVu}}</p>

                                    @foreach ($item->quyens()->get() as $q)
                                    <li style="display: flex; ">
                                        <span style="width: 25%; text-align: center;" class='ten-quyen'>{{$q->tenQuyen}}</span>
                                        <span style="width: 70%;" >{{$q->moTa}}</span>
                                    </li>
                                    @endforeach
                               @endforeach
                             
                           </ul>
                        </div>   
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection

@section('footer')
@parent
<script>

    $("#photo").on('change', function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                $(".avatar img").attr('src', fr.result);
                $(".avatar button").show();
            }
            fr.readAsDataURL(files[0]);
        }


    });

    $(".avatar button").click(
        function (e) {
            e.preventDefault();
            var id = $("#idTK").text();
            var form = new FormData();
            form.append('avatar', $("#photo").prop('files')[0]);

            alertify.confirm('Bạn có muốn thay đổi ảnh đại diện??',
                ///Yes
                function () {
                    // alertify.success('thanh cong');
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

                        type: 'post',
                        async: false,

                        data: form,

                        url: "/admin/danhmuc/taikhoan/avatar/" + id,
                        success: function (data) {
                            console.log(data);
                        }
                    }).done(function () {
                        alertify.success('Sửa thành công thành công');

                    });
                },
                function () {
                    alertify.error('Đã hủy');
                });
        });

</script>
@endsection