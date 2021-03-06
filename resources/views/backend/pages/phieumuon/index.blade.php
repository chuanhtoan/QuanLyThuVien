@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    .table {
        font-family: 'Fira Sans', sans-serif;
    }

    .table thead th {
        /* font-family: 'Noto Serif', serif; */
        font-family: 'Fira Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: bolder;
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
            <a href="/admin/danhmuc/phieumuon/create">
                <button class="btn btn-primary" style="background-color: #008f45; border: none; float: right;margin-right: 3rem;">Add</button>
            </a>
        </div>

        <div class="row">
            <div class="white-box">
                <div class="table-responsive" id="tb_tl">
                    @php ($index = ($page-1)*5 +1)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>NGÀY MƯỢN</th>
                                <th>NGÀY HẸN TRẢ</th>
                                <th>ĐỘC GIẢ</th>
                                <th>NHÂN VIÊN</th>
                                <th>THAO TÁC</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($arr as $item)
                            <tr>
                                <td>{{$index++}}</td>
                                <td class="txt-oflo">{{$item->id}} </td>
                                <td class="txt-oflo">{{$item->ngayMuon->format('d-m-Y')}}</td>
                                <td class="txt-oflo">{{$item->ngayHenTra->format('d-m-Y')}} </td>
                                <td class="txt-oflo">{{$item->tenDocGia}} </td>
                                <td class="txt-oflo">{{$item->tenNhanVien}} </td>
                                <td>
                                    {{-- <a href="{{route('chitietphieumuon.show',$item->id) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Xem</button></a> --}}
                                    <a href="{{route('phieumuon.edit',$item->id) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                                    <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
                                    <button type="button" value="{{$item->id}}" class="xuat btn btn-info">Xuất</button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example" style="text-align: center">
                        {!!$arr->links()!!}
                    </nav>
                    {{-- @include('backend.pages.phieumuon.phantrang',['arr'=>$arr]) --}}
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

    var page = 1;
    const urlPhanTrang = "/admin/danhmuc/phieumuon/phantrang?page=";
    const urlXoa  = "/admin/danhmuc/phieumuon/";
    // Chay Phan trang 
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        page = $(this).attr("href").split('page=')[1];
      
        loadAjax(page);

    });

    


    // xoa the loai
    $(document).on('click', '.table .xoa', function () {
        var id = $(this).val();
        alertify.confirm("Bạn có muốn xóa phiếu mượn này??",
            function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "delete",
                    url: urlXoa + id,
                    success: function (data) {
                        console.log(data.size);
                        if(data.size%5 ==0&&data.size/5>=1  ){
                            page--;
                           
                     }
                    }
                }).done(function () {
                    alertify.success('Xóa thành công');
                   
                    loadAjax(page);
                });
            },
            function () {
                alertify.error('Đã hủy');
            });

    });



    /// hamg xu ly load phan trang
    function loadAjax(page_) {
        
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: urlPhanTrang + page_,

        }).done(function (response) {
           
            $("#tb_tl").empty();
            $("#tb_tl").html(response);

        });
    }

// ========XUAT PDF FILE PHIEU MUON
$(document).on('click', '.table .xuat', function () {
    var id = $(this).val();
    var url =  window.location.origin+'/admin/danhmuc/phieumuon/review/'+id;
    console.log(url);
        alertify.confirm("Bạn có muốn in phiếu mượn này về máy??",
            function () {
                var w = window.open(url);
                if(w)
                   w.print();
            },
            function () {
                alertify.error('Đã hủy');
            });
});


</script>
@endsection