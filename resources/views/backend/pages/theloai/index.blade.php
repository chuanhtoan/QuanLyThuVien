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
                <h4 class="page-title">Sach/The Loai</h4>
            </div>
            <a href="/admin/danhmuc/theloai/create">
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
                                <th>TÊN THỂ LOẠI</th>
                                <th>ID THỂ LOẠI CHA</th>
                                <th>THAO TÁC</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($arr as $item)
                            <tr>
                                <td>{{$index++}}</td>
                                <td class="txt-oflo">{{$item->id}} </td>
                                <td>{{$item->tenTheLoai}}</td>
                                <td class="txt-oflo">{{$item->ID_Cha}} </td>
                                <td>
                                <a href="{{route('theloai.edit',['theloai'=>$item->id])}}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                                    <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <nav aria-label="Page navigation example" style="text-align: center">
                        {!!$arr->links()!!}
                    </nav>
                    {{-- @include('backend.pages.theloai.phantrang',['arr'=>$arr]) --}}
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
    // Chay Phan trang 
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        page = $(this).attr("href").split('page=')[1];
        loadAjax(page);

    });


    // xoa the loai
    $(document).on('click', '.table .xoa', function () {
        var id = $(this).val();
        alertify.confirm("Bạn có muông xóa thể loại này, lưu ý khi xóa xong các thể loại con của nó sẽ" +
            " được chuyển lên node cha",
            function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "delete",
                    url: "/admin/danhmuc/theloai/" + id,
                    success: function (data) {
                        
                        if(data.size%5 ==0&&data.size>1  )
                           page--;
                    }
                }).done(function () {
                    alertify.success('Xóa thành công');
                    console.log(page);
                    loadAjax(page);
                });
            },
            function () {
                alertify.error('Đã hủy');
            });

        // var yes = confirm("Bạn có muông xóa thể loại này, lưu ý khi xóa xong các thể loại con của nó sẽ" +
        //     " được chuyển lên node cha");
        // if (yes) {
        //     var id = $(this).val();
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         type: "delete",
        //         url: "/admin/danhmuc/theloai/" + id,
        //         success:function(data){
        //             console.log(data);
        //         }
        //     }).done(function () {
        //         alertify.success('Xóa thành công');
        //         loadAjax(page);
        //     });


        // }
    });



    /// hamg xu ly load phan trang
    function loadAjax(page_) {

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "/admin/danhmuc/theloai/phantrang?page=" + page_,

        }).done(function (response) {
            $("#tb_tl").empty();
            $("#tb_tl").html(response);
        });
    }


</script>
@endsection