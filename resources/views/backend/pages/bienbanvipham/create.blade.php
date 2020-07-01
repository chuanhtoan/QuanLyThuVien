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

    input#ngayMuon {
        background-color: white;
    }

    .table th {
        font-family: 'Noto Serif', serif;
    }

    .chitietphieumuon .title-chitiet {
        width: 100%;
        text-align: center;
        margin: 0 auto;
        border-bottom: solid rgb(214, 214, 214) 0.6px;
        padding-bottom: 2rem;
        font-size: 2rem;
        font-family: 'Roboto', sans-serif;
    }

    input[type=date]:disabled,input[type=text]:disabled{
        background-color: white;
    }
</style>
@endsection
{{-- {{$html}} --}}

@section('noi-dung')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Phieu Muon</h4>
            </div>
        </div>

        <div class="white-box">
            <form id="bienbanForm" action="{{route('phieumuon.store')}}" method="post">
                @csrf
                {{-- Nhap ten Phieu Muon --}}

                <div>
                    <label for="ngayLap">Ngày lập</label>
                    <input disabled type="date" class="form-control" required name="ngayLap" id="ngayLap">
                </div>

                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="maPhieuMuon">Mã phiếu mượn</label>
                    <input type="text" class="form-control" required name="maPhieuMuon" id="maPhieuMuon">
                </div>

                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="maNhanVien">Nhân viên lập</label>
                    <select class="form-control" id="maNhanVien">
                          @foreach ($nhanvien as $item)
                              <option value="{{$item->id}}">{{$item->hoTen}}</option>
                          @endforeach
                    </select>
                </div>

                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="maDocGia">Mã độc giả</label>
                    <input type="text" disabled class="form-control"  name="maDocGia" id="maDocGia">
                </div>

                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label style="display: block" for="tienPhat">Tiền phạt</label>
                    <input style="display: inline-block;width:30%" type="text" class="form-control" required name="tienPhat" id="tienPhat">
                    <label> VND</label>
                </div>

                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="noiDung">Nội dung ghi chú</label>
                    <textarea class="form-control" name="noiDung" id="noiDung" style="height: 150px"></textarea>
                </div>
              
            </form>
            <div class="text-center" style="margin-top: 5rem;">
                <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                <button type="button" id="check" class="btn btn-primary">Lưu</button>
                <a href="{{route('vipham.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
            </div>



        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>
    var now = new Date();
    now.setDate(now.getDate() + 5);

    // console.log(now);
    const urlPost = '/admin/danhmuc/vipham';
    $("#check").click(function () {
        var hl = $("#bienbanForm").valid();
        if (hl) {
            thucHienAjax();
        }
    });

    // ===============  PHAN VALIDATE DU LIEU   ================ //
    //  KIEM TRA MA PHIEU MUON CO TRONG CO SO DU LIEU KHONG
    $.validator.addMethod("kiemTraTrung", function (value, element) {
         var kiemTra= false;
         $.ajax({
            url: '/admin/danhmuc/phieumuon/kttontai/'+value,
            type: 'get',
            async: false,
            success: function(data){
                if(data['yes'] == 'true' ) {
                   kiemTra = true; 
                   gangDuLieu(data['docgia']);
                   }
            } 
         });
         return kiemTra;
    });


    $("#bienbanForm").validate({
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
            maPhieuMuon:{
                digits : true,
                required : true,
                kiemTraTrung : true
            },
            tienPhat: {
                digits : true,
                required : true,
            },
            noiDung : {
                required : true,
            }
        },
        messages: {
            maPhieuMuon:{
                kiemTraTrung : 'Phiếu mượn không tồn tại',
                required : 'Yêu cầu nhập mã phiếu mượn',  
            },
            tienPhat: {
                digits : "Dữ liệu không hợp lệ",
                required : "Yêu cầu nhập tiền phạt",
            },
            noiDung : {
                required : "Yêu cầu nhập mô tả đóng phạt",
            }
        }, errorPlacement: function (err, elemet) {

            err.insertAfter(elemet);
            err.addClass('invalid-feedback d-inline text-danger');
            elemet.addClass('form-control is-invalid');
            $('.focus-input100-1,.focus-input100-2').addClass('hidden');
        }
    });

    //=============== KET THUC VALIDATE ==================== 


    ///  ==================   CHUAN BI ===============
    $(document).ready(function (e) {
     
        var d = new Date();
        let moth = d.getMonth() + 1;
        let year = d.getFullYear();
        let date = d.getDate();
        $('#ngayLap').val(`${year}-${moth < 9 ? '0' + moth : moth}-${date < 9 ? '0' + date : date}`);
    });

//   ==============  LAY THONG TIN DOC GIA ==========

function gangDuLieu(docGia){
    $('#maDocGia').val(docGia);
}

 

//   ==============  LUU BIEN BAN  ====================

function thucHienAjax() {
        var obj = {
            'ID_PhieuMuon':$('#maPhieuMuon').val(),
            'ID_NhanVien': $('#maNhanVien option:selected').val(),
            'ngayLap' :$('#ngayLap').val(),
            'noiDung' : $('#noiDung').val(),  
            'tienPhat' : $('#tienPhat').val(),  
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

                if (response['yes'] == true) {

                    $('#maPhieuMuon').val('');
                    $('#noiDung').val('');
                    $('#tienPhat').val('');
                    $('maDocGia').val('');
                    chiTietSach = new Array();
                    alertify.success('Thêm biển bản vi phạm thành công');
                }
            }
        });
    }
</script>
@endsection