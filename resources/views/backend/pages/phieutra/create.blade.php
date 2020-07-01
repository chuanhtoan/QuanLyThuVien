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

    input[type=date]:disabled,
    input[type=text]:disabled {
        background-color: white;
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
            <form id="phieutraForm" action="{{route('phieutra.store')}}" method="post">
                @csrf
                {{-- Nhap ten Phieu Muon --}}

                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="maPhieuMuon">Mã phiếu mượn</label>
                    <input type="text" class="form-control" required name="maPhieuMuon" id="maPhieuMuon">
                </div>


                <div>
                    <label for="ngayTra">Ngày Trả</label>
                    <input disabled type="date" class="form-control" required name="ngayTra" id="ngayTra">
                </div>



                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="selectDocGia">Nhân Viên</label>
                    <select class="form-control" id="selectNhanVien" name="selectNhanVien" required>
                        @foreach($itemnhanvien as $items)
                        <option value="{{$items->id}}">{{$items->hoTen}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="chitietphieumuon" style="margin-top: 5rem; ">
                    <div class="title-chitiet">Chi tiết phiếu mượn</div>
                    <div style="margin-top:2rem ;margin-right:1rem ;">
                        <label for="maCuonSach" style="display: block">Mã Cuốn Sách</label>
                        <input type="text" class="form-control" name="maCuonSach" id="maCuonSach"
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
                <a href="{{route('phieutra.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost = '/admin/danhmuc/phieutra';
    $("#check").click(function () {
        var hl = $("#phieutraForm").valid();
        if (hl) {
            // NEU KHONG CO VI PHAM THI TIEN HANH LAP PHIEU TRA BINH THUONG
           kiemTraViPham();
            // if (kiemTraViPham())
            //     thucHienAjax();
        }
    });

    // ===============  PHAN VALIDATE DU LIEU   ================ //
    //  KIEM TRA MA PHIEU MUON CO TRONG CO SO DU LIEU KHONG

    $.validator.addMethod("kiemTraTrung", function (value, element) {
        var kiemTra = false;
        $.ajax({
            url: '/admin/danhmuc/phieumuon/kttontai/' + value,
            type: 'get',
            async: false,
            success: function (data) {
                if (data['yes'] == 'true') {
                    kiemTra = true;
                }
            }
        });
        return kiemTra;
    });


    $("#phieutraForm").validate({
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
            maPhieuMuon: {
                required: true,
                kiemTraTrung: true
            },
        },
        messages: {
            maPhieuMuon: {
                kiemTraTrung: 'Phiếu mượn không tồn tại',
                required: 'Yêu cầu nhập mã phiếu mượn',
            },

        }, errorPlacement: function (err, elemet) {

            err.insertAfter(elemet);
            err.addClass('invalid-feedback d-inline text-danger');
            elemet.addClass('form-control is-invalid');
            $('.focus-input100-1,.focus-input100-2').addClass('hidden');
        }
    });
    //=============== KET THUC VALIDATE ==================== 




    //  =================  LY NGAY THANG HIEN TAI ==================
    $(document).ready(function (e) {
        $('#khong-ton-tai').hide();

        var d = new Date();
        let moth = d.getMonth() + 1;
        let year = d.getFullYear();
        let date = d.getDate();
        $('#ngayTra').val(`${year}-${moth < 9 ? '0' + moth : moth}-${date < 9 ? '0' + date : date}`);
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
        var chitiet_phieumuon_url = "/admin/danhmuc/phieutra/them_chitiet/" + maCuonSach;
        console.log(maCuonSach);
        $.ajax({
            url: chitiet_phieumuon_url,
            type: 'post',
            data: { maPhieuMuon: $('#maPhieuMuon').val() },
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

            //CUON SACH HOP LE
            if (data['yes'] == 0) {
                // THEM CUON SACH       
                $('.table tbody').append(data['data']);
                $('#khong-ton-tai').hide();
                chiTietSach.push($('#maCuonSach').val());
                $('maCuonSach').val('');

            }
            //  CUON SACH KO TON TAI TRONG KHO HOAC KO O TRONG PHIEU MUON
            else if (data['yes'] == 1) {
                alertify.alert("Cuốn sách không trong kho hoặc không ở trong phiếu mượn", function () {
                    alertify.success('ĐÃ HIỂU');
                });
            }
            else if (data['yes'] == 2) {
                $('#khong-ton-tai').text('Hãy nhập mã phiếu mượn đi chứ');
                $('#khong-ton-tai').show();
            }

        }

    });

    // =============== XOA CUON SACH RA KHOI CHI TIET SACH ==============
    $(document).on('click', '.table .xoa', function (e) {
        var ma = $(this).val();
        var nth = chiTietSach.indexOf(ma);

        $(`.table tbody tr:nth-child(${nth + 1}) `).remove();
        chiTietSach.splice(nth, 1);
    });

       // ===================== KIEM TRA VI PHAM  =================
       function kiemTraViPham() {
        var kt = false;
        $.ajax({
            type: 'post',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                maPhieuMuon: $("#maPhieuMuon").val(),
                chitiet: chiTietSach
            },
            url: '{{route('phieutra.ktvipham')}}',
            async: false,
            success: function (data) {
                console.log(data);
                if (data['size'] == 0){
                   thucHienAjax();
                }
                else {
                    hienViPham(0,data,kt);
                }
            }
        });
      
    }

    function hienViPham(i, data,kt) {
       
        if (i == data['size']) {
            alertify.confirm(
                'Bạn có muốn tiếp tục lập phiếu mượn?',
                ()=> { thucHienAjax()},
                ()=> { }
            );
        } else {
           
            if (data['mess'][i + ''] != '') {
                setTimeout(function () {
                    alertify.alert(data['mess'][i + ''], function () {
                        alertify.success('Đã hiểu');
                        hienViPham(i + 1, data,kt);
                    });
                }, 600);
            } else {
                setTimeout(hienViPham(i + 1, data,kt), 900);
            }
        }
    }


    // LUU PHIEU TRA


    function thucHienAjax() {
        var obj = {
            // 'ngayTra': $("#ngayTra").val(),
            'ID_PhieuMuon': $("#maPhieuMuon").val(),
            'ID_NhanVien': $("#selectNhanVien").children('option:selected').val(),
            'chitiet': chiTietSach
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
                    $("#maPhieuMuon").val('');

                    alertify.success('Thêm phiếu trả thành công');
                }
            }
        });
    }

 
</script>
@endsection