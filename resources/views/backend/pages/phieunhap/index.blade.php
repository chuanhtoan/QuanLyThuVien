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
                <h4 class="page-title">Phieu Tra</h4>
            </div>
            <a href="/admin/danhmuc/phieunhap/create">
                <button class="btn btn-primary" style="background-color: #008f45; border: none; float: right;margin-right: 3rem;">Add</button>
            </a>
        </div>

        <div class="row">
            <div class="white-box">
                <div class="table-responsive" id="tb_tl">
                    @include('backend.pages.phieunhap.phantrang',['arr'=>$arr,'page'=>1])
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
    const urlPhanTrang = "/admin/danhmuc/phieunhap/phantrang?page=";
    const urlXoa  = "/admin/danhmuc/phieunhap/";
    // Chay Phan trang 
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        page = $(this).attr("href").split('page=')[1];
      
        loadAjax(page);

    });

    


    // xoa the loai
    $(document).on('click', '.table .xoa', function () {
        var id = $(this).val();
        alertify.confirm("Bạn có muốn xóa phiếu này??",
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


</script>
@endsection