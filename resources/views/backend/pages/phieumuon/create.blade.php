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
            <form id="phieumuonForm" action="{{route('phieumuon.store')}}" method="post">
                @csrf
                {{-- Nhap ten Phieu Muon --}}

                <div>
                    <label for="ngayMuon">Ngày Mượn</label>
                    <input disabled type="date" class="form-control" required name="ngayMuon" id="ngayMuon">
                </div>

                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="ngayHenTra">Ngày Hẹn Trả</label>
                    <input type="date" class="form-control" required name="ngayHenTra" id="ngayHenTra">
                </div>

                <div style="display: flex;">

                    <div style="margin-top:2rem ;margin-right:1rem ;width: 40%;">
                        <label for="selectDocGia">Độc Giả</label>
                        <select class="form-control" id="selectDocGia" name="selectDocGia" required>
                            <!-- <option value="" disabled selected>Chọn tên độc giả</option> -->
                            @foreach($itemdocgia as $item)
                            <option value="{{$item->id}}">{{$item->hoTen}}</option>
                            @endforeach
                        </select>
                    </div>



                    <div style="margin-top:2rem ;margin-right:1rem ; width: 40%;">
                        <label for="selectNhanVien">Nhân Viên</label>
                        <select class="form-control" id="selectNhanVien" name="selectNhanVien" required>
                            <!-- <option value="" disabled selected>Chọn tên độc giả</option> -->
                            @foreach($itemnhanvien as $item)
                            <option value="{{$item->id}}">{{$item->hoTen}}</option>
                            @endforeach
                        </select>
                    </div>

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
                <a href="{{route('phieumuon.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
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
    const urlPost = '/admin/danhmuc/phieumuon';
    $("#check").click(function () {
        var hl = $("#phieumuonForm").valid();
        if (hl) {
            thucHienAjax($("#phieumuonForm"));
        }
    });

    // ===============  PHAN VALIDATE DU LIEU   ================ //
    //  KIEM TRA NGAY LON HON NGAY DUOC TUY CHON
    $.validator.addMethod("dateTo", function (value, element, params) {
        try {
            var date = new Date(value);
            if (date <= params) {
                return true;
            }
        } catch (e) { }
        return false;
    });
    //  KIEM TRA NGAY NHO HON NGAY DUOC TUY CHON
    $.validator.addMethod("dateFrom", function (value, element, params) {
        try {
            var date = new Date(value);
            if (date >= params) {
                return true;
            }
        } catch (e) { }
        return false;
    });

    $("#phieumuonForm").validate({
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
            ngayHenTra: {

                dateFrom: new Date(),
                dateTo: now,
                required: true
            }
        },
        messages: {
            ngayHenTra: {
                dateFrom: 'Ngày hẹn trả nhở hơn ngày mượn, chém gió à',
                dateTo: 'Chỉ được phép mượn tối đa 5 ngày',
                required: 'Không được bỏ trống'
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
        $('#khong-ton-tai').hide();
      
        var d = new Date();
        let moth = d.getMonth() + 1;
        let year = d.getFullYear();
        let date = d.getDate();
        $('#ngayMuon').val(`${year}-${moth < 9 ? '0' + moth : moth}-${date < 9 ? '0' + date : date}`);
    });

    // ====================   THEM CUON SACH ===============
    var chiTietSach = new Array();
    // KIEM TRA SACH CO TRUNG

    function kiemTraTrung(maCuonSach) {
        return chiTietSach.indexOf(maCuonSach) > -1;
    }

    // KIEM TRA SU TON TAI CUA CUON SACH
    function kiemTraTonTai(maCuonSach) {
      
        var data_ = {};
        var chitiet_phieumuon_url = "/admin/danhmuc/phieumuon/them_chitiet/" + maCuonSach;
        $.ajax({
            url: chitiet_phieumuon_url,
            type: 'post',
            data: { obj: chiTietSach, docGia: $('#selectDocGia option:selected').val() },
            async: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (data) {
                data_['yes'] = data['yes'];
                if (data['yes'] == 0) {
                    data_['data'] = data['data'];

                }
            }
        });
        // console.log(data_);
        return data_;
    }


    $('#them-cuon-sach').click(function () {
        var data = "";

        // KIEM TRA MA CUON SACH CO DUOC THEM VAO CHUA
        if (kiemTraTrung($('#maCuonSach').val())) {
            $('#khong-ton-tai').text('Bạn vừa mới thêm cuốn sách này vào rồi');
            $('#khong-ton-tai').show();
        } else {
            data = kiemTraTonTai($('#maCuonSach').val());
            // console.log(data);

            // KIEM TRA TON TAI CUON SACH TRONG KHO
            if (data['yes'] == 0) {
                // THEM CUON SACH       
                $('.table tbody').append(data['data']);
                $('#khong-ton-tai').hide();
                chiTietSach.push($('#maCuonSach').val());
                $('maCuonSach').val('');

            }
            //  KIEM TRA SO LUONG SACH MUON CO DUOI MUC CHO PHEP KHONG(=7 CUON)
            else if (data['yes'] == 1){
                alertify.alert("Số lượng sách bạn đã mượn đã quá 7 cuốn (bao gồm các lần mượn trước)", function(){
                    alertify.success('ĐÃ HIỂU');
                });
            }
              // XUAT THONG BAO NEY KHONG TON TAI
             else {
                $('#khong-ton-tai').text('Cuốn sách không tồn tại hoặc đã được mượn')
                $('#khong-ton-tai').show();
            }
        }

    });

    // =============== XOA CUON SACH RA KHOI CHI TIET SACH ==============
    $(document).on('click', '.table .xoa', function (e) {
        var ma = $(this).val();
        var nth = chiTietSach.indexOf(ma);
        
        $(`.table tbody tr:nth-child(${nth+1}) `).remove();
        chiTietSach.splice(nth,1);
    });



//   ==============  LUU PHIEU MUON ====================

function thucHienAjax(form) {
        var obj = {
            'chitiet':chiTietSach,
            'ngayHenTra' :$('#ngayHenTra').val()+' 23:00:00',
            'ID_NhanVien' : $('#selectNhanVien option:selected').val(),  
            'ID_DocGia' : $('#selectDocGia option:selected').val(),  
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

                    $('.table tbody').empty();
                    $('#ngayHenTra').val('');
                    $('#maCuonSach').val('');
                    chiTietSach = new Array();
                    alertify.success('Thêm phiếu mượn thành công');
                }
            }
        });
    }
</script>
@endsection