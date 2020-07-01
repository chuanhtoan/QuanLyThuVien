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
                <h4 class="page-title">Chi Tiet Phieu Trả</h4>
            </div>
        </div>

        <div class="white-box">
            <form id="chitietphieutraForm" action="{{route('chitietphieutra.store')}}" method="post">
                @csrf
                {{-- Nhap ten Phieu Muon --}}
                
                <div>
                    <label for="selectPhieuTra">Phiếu trả</label>
                    <select class="form-control" id="selectPhieuTra" name="selectPhieuTra" required>
                            <option value="" disabled selected>Chọn phiếu trả</option>
                            @foreach($itemphieutra as $item)
                            <option value="{{$item->id}}">{{$item->id}}</option>
                            @endforeach
                    </select>
                </div>
                
               
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="selectCuonSach">Cuốn sách</label>
                    <select class="form-control" id="selectCuonSach" name="selectCuonSach" required>
                            <option value="" disabled selected>Chọn cuốn sách</option>
                            @foreach($itemcuonsach as $item)
                            <option value="{{$item->id}}">{{$item->id}}</option>
                            @endforeach
                    </select>
                </div>

                <div class="chitietphieumuon" style="margin-top: 5rem; ">
                    <div class="title-chitiet">Chi tiết phiếu mượn</div>
                    <div style="margin-top:2rem ;margin-right:1rem ;">
                        <label for="maCuonSach" style="display: block">Mã Cuốn Sách</label>
                        <input type="text" class="form-control"  name="maCuonSach" id="maCuonSach"
                            style="width: 20%;display: inline-block;">

                        <button type="button" id="them-cuon-sach" class="btn btn-success">Add</button>
                        <label class="invalid-feedback text-danger" id='khong-ton-tai' style="display: block">Cuốn sách
                            đã tồn tai</label>
                    </div>
                    <div class="table-responsive" id="tb_tl">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>MÃ CUỐN SÁCH</th>
                                    <th>TÊN SÁCH</th>
                                    <th>THAO TÁC</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>

            </form>
            <div class="text-center" style="margin-top: 5rem;">
                <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                <button type="button" id="check" class="btn btn-primary">Lưu</button>
                <a href="{{route('chitietphieutra.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
            </div>

        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost='/admin/danhmuc/chitietphieutra';
    $("#check").click(function () {
        var hl = $("#chitietphieutraForm").valid();
        if (hl) {
            thucHienAjax();
        }
    });

    // $("#chitietphieutraForm").validate({
    //     onfocusout: function (element) {
    //         if ($(element).val() == "") return;
    //         var hl = $(element).valid();
    //         if (hl) {

    //             if ($(element).hasClass('is-invalid'))
    //                 $(element).removeClass("form-control is-invalid");
    //             $(element).addClass('form-control is-valid');
    //         }
    //     }, onkeyup: false,
    //     rules: {
    //         namSinh:{
    //             // min:'1950',
    //             // max: '2020',
    //             required:true
    //         },
    //     },
    //     messages: {
    //         namSinh:{
    //             // min:'Năm sinh quá lâu, chém gió à',
    //             // max: 'Năm sinh lớn hơn hiện tại, chém gió à',
    //             required:'Không được bỏ trống'
    //         },
    //     }, errorPlacement: function (err, elemet) {
        
    //     err.insertAfter(elemet);    
    //     err.addClass('invalid-feedback d-inline text-danger');
    //     elemet.addClass('form-control is-invalid');
    //     $('.focus-input100-1,.focus-input100-2').addClass('hidden');
    // }
    //});
    function thucHienAjax() {
        var obj = {
            'ID_PhieuTra': $("#selectPhieuTra").children('option:selected').val(),
            'ID_CuonSach': $("#selectCuonSach").children('option:selected').val(),
        };
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

                //    var now = new Date();
                //     $("#ngayMuon").val("");
                //     $("#ngayHenTra").val( now.getTime());
                //     $("#ID_DocGia").val("");
                //     $("#ID_NhanVien").val("");

                    alertify.success('Thêm chi tiết phiếu trả thành công');
                }
            }
        });
    }



</script>
@endsection