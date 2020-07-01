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
            <form id="phieuyeucauForm" action="{{route('phieutra.store')}}" method="post">
                @csrf
                {{-- Nhap ten Phieu Muon --}}

                <div>
                    <label for="ngayLap">Ngày Lập</label>
                    <input disabled type="date" class="form-control" required name="ngayLap" id="ngayLap">
                </div>



                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="selectDocGia">Nhân Viên</label>
                    <select class="form-control" id="selectNhanVien" name="selectNhanVien" >
                        @foreach($itemnhanvien as $items)
                        <option value="{{$items->id}}">{{$items->hoTen}}</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="selectNXB">Nhà Xuất Bản</label>
                    <select class="form-control" id="selectNXB" name="selectNXB" >
                        @foreach($itemnhaxb as $items)
                          <option value="{{$items->id}}">{{$items->tenNXB}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="chitietphieumuon" style="margin-top: 5rem; ">
                    <div class="title-chitiet">Chi tiết phiếu yêu cầu</div>
                    <div style="margin-top:2rem ;margin-right:1rem ;">
                        
                        <div style="display: flex">
                            <div style="width: 30%">
                                <label for="maSach" style="display: block">Mã Sách</label>
                                <select class="form-control" name="maSach" id="maSach"
                                    style="width: 90%;display: inline-block;">
                                    @include('backend.pages.phieuyeucau.select_sach_nhaxb',['item'=>$itemnhaxb->first()])  
                                </select> 
                                <label class="invalid-feedback text-danger" id='khong-ton-tai' style="display: block">Cuốn sách
                                    đã tồn tai</label>
                            </div>
                            <div style="width: 30%">
                                <label for="soLuong" style="display: block">Số lượng sách</label>
                                <input type="text" class="form-control" required name="soLuong" id="soLuong"
                                style="width: 70%;display: inline-block;">
                                <button type="button" id="them-cuon-sach" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" id="tb_tl">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>MÃ SÁCH</th>
                                    <th>TÊN SÁCH</th>
                                    <th>SỐ LƯỢNG SÁCH</th>
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
                <a href="{{route('phieuyeucau.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost = '/admin/danhmuc/phieuyeucau';
    $("#check").click(function () {
        var hl = $("#phieuyeucauForm").valid();
        if (hl) {
             thucHienAjax();
        }
    });

    // LUU PHIEU TRA
    function thucHienAjax() {
        var obj = {
            // 'ngayTra': $("#ngayTra").val(),
            'ID_NhaXB': $("#selectNXB option:selected").val(),
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

                if (response['yes'] === true) {

                    chiTietSach = new Array();
                    $('.table tbody').empty();
                    alertify.success('Thêm phiếu thành công');
                }
            }
        });
    }

//=============== CHUAN BI 
    $(document).ready(function (e) {      
        $('#khong-ton-tai').hide();
        var d = new Date();
        let moth = d.getMonth() + 1;
        let year = d.getFullYear();
        let date = d.getDate();
        $('#ngayLap').val(`${year}-${moth < 9 ? '0' + moth : moth}-${date < 9 ? '0' + date : date}`);
    });

//================== SU KIEN CLICK CHON NXB
$('#selectNXB').blur(function(){
    $.ajax({
        url:'{{route('phieuyeucau.get_nhaXB_sach')}}',
        type:'get',
        data: {ID_NhaXB:$(this).children('option:selected').val()},
        success: function(data){
            chiTietSach = new Array();
            $('.table tbody').empty();
            $('#maSach').empty();
            $('#maSach').html(data);
        }  
    });
});
 

// ===========  THEM SACH VAO CHITIET
var chiTietSach = new Array();

function kiemTraTrung(maCuonSach) {
   for(let i = 0;i<chiTietSach.length;i++)
      if(chiTietSach[i]['sach']==maCuonSach )
          return i;
   return -1;
}

function layDuKieu_Row(maSach){
    var data = '';
    $.ajax({
        url : '/admin/danhmuc/phieuyeucau/them_chitiet/'+maSach,
        data: {soLuong: $('#soLuong').val()},
        type: 'post',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        async: false,
        success : function (data_) { 
            if(data_['yes']==true)
            data = data_['data']; 
        }
    });
    return data; 
}

$('#them-cuon-sach').click(function (){
    var data = "";
    // KIEM TRA MA CUON SACH CO DUOC THEM VAO CHUA
    if (kiemTraTrung($('#maSach option:selected').val()) > -1) {
        $('#khong-ton-tai').text('Bạn vừa mới thêm cuốn sách này vào rồi');
        $('#khong-ton-tai').show();
    }else{
        data = layDuKieu_Row($('#maSach option:selected').val());
        $('.table tbody').append(data);
            $('#khong-ton-tai').hide();
            chiTietSach.push(
                {
                    sach:$('#maSach option:selected').val(),
                    soLuong: $('#soLuong').val()
                }
            );
    }
});

// ================= XOA DONG DUOC CHON
$(document).on('click', '.table .xoa', function (e) {
        var ma = $(this).val();
        var nth = kiemTraTrung(ma);
        $(`.table tbody tr:nth-child(${nth+1}) `).remove();
        chiTietSach.splice(nth,1);
    });

</script>
@endsection