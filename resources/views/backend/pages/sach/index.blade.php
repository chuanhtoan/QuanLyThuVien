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
    #modalForm td{
        padding-top:10px; 
    }
    .title-loc{
        text-align: end;
    }
    .body-loc{
        text-align: start;
        padding-left: 10px;
    }
 
</style>
@endsection
{{-- {{$html}} --}}

@section('noi-dung')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Sách</h4>
            </div>
            <a href="/admin/danhmuc/sach/create">
                <button class="btn btn-primary" style="background-color: #008f45; border: none; float: right;margin-right: 3rem;">Add</button>
            </a>
        </div>

        <div class="row">
            <div class="white-box">
                @if ( isset($error) )
                    <div style="font-size: 1.4rem; text-align: center">Không có dũ liệu</div>    
                @else
                <div>
                    <button type="button" class="btn btn-info" id="tim-kiem-sach">Tìm kiếm</button>
                </div>
                <div class="table-responsive" id="tb_tl">
                    @php ($index = ($page-1)*5 +1)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>TÊN SÁCH</th>
                                <th>TÁC GIẢ</th>
                                <th>THỂ LOẠI</th>
                                <th>NHÀ XUẤT BẢN</th>
                                <th>CHO PHÉP MƯỢN</th>
                                <th>THAO TÁC</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($arr as $item)
                            <tr>
                                <td>{{$index++}}</td>
                                <td class="txt-oflo">{{$item->id}} </td>
                                <td>{{$item->tenSach}}</td>
                                <td class="txt-oflo">{{$item->hoTen}} </td>
                                <td class="txt-oflo">{{$item->tenTheLoai == "" ? "Chưa rõ":$item->tenTheLoai}} </td>
                                <td class="txt-oflo">{{$item->tenNXB == "" ? "Chưa rõ":$item->tenNXB}} </td>
                                <td class="txt-oflo">{{$item->duocPhepMuon == "" ? "Chưa":"Được"}} </td>
                                
                                <td>
                                    <a href="{{route('sach.edit',$item->id ) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                                    <a href="{{route('sach.review',$item->id ) }}"><button type="button" value="{{$item->id}}" class="soan btn btn-primary">Soạn bài</button></a>
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
                @endif
            </div>

        </div>
    </div>

    <div id = 'dialog'>
      
    </div>
</div>

@endsection

@section('footer')
@parent
<script>

    var page = 1;
    const urlPhanTrang = "/admin/danhmuc/sach/phantrang?page=";
    const urlXoa  = "/admin/danhmuc/sach/";
    // Chay Phan trang 
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        page = $(this).attr("href").split('page=')[1];
      
        loadAjax(page);

    });

    


    // xoa the loai
    $(document).on('click', '.table .xoa', function () {
        var id = $(this).val();
        alertify.confirm("Bạn có muông xóa sách này??",
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
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        $.ajax({
           
            url: urlPhanTrang + page_,

        }).done(function (response) {
           
            $("#tb_tl").empty();
            $("#tb_tl").html(response);

        });
    }



  // LOC SACH THEO TUY CHON
  // Hien dialog  
   $('#tim-kiem-sach').on('click',function(e){
        $.ajax({
            url: '{{route('sach.loc-dialog')}}',
            acsyn: false,
            success: function(data){
                $('#dialog').html(data);  
                $('#modalForm').show();
                alertify.genericDialog($('#modalForm')[0]).set('closable',false); 
            }
        } );
       
   });


   // CAI DAT DIALOG
   alertify.dialog('genericDialog', function () {
            return {
                main: function (content) {
                    this.setContent(content);
                },
                setup: function () {
                    return {
                        focus: {
                            element: function () {
                                return this.elements.body.querySelector(this.get('selector'));
                            },
                            select: true
                        },
                        options: {
                            basic: true,
                            maximizable: false,
                            resizable: false,
                            padding: false

                        }
                    };
                },
                settings: {
                    selector: undefined,
                    title: "Lọc sách"
                },
                hooks: {
                    onshow: function () {
                        this.elements.dialog.style.maxWidth = 'none';
                        this.elements.dialog.style.width = '40%';
                    }
                }
            };
        });

    //  TRA VE KET QUA, RESULT
    
    $(document).on('click','#modalForm .loc-ok',function (e) {
            e.preventDefault();
            var result={};
            result['id'] = $('#modalForm #id').val(); 
            result['tenSach'] = $('#modalForm #tenSach').val(); 
            result['theLoai'] = $('#modalForm #theLoai').val(); 
            result['tacGia'] = $('#modalForm #tacGia').val(); 
            result['nxb'] = $('#modalForm #nxb').val(); 
            result['duocPhep'] = $('#modalForm #duocPhep option:selected').val(); 
            // result['ngayMuon'] = {
            //     'tu': $('#modalForm #muonTu').val(),
            //     'den': $('#modalForm #muonDen').val()
            // }; 
            // result['ngayTra'] = {
            //     'tu': $('#modalForm #traTu').val(),
            //     'den': $('#modalForm #traDen').val()
            // };
            
            console.log(result);
            alertify.genericDialog().close();
            $('#loginForm').hide();
            $.ajax({
                url: "{{route('sach.loc-kq')}}",
                data: result,
                success: function(data){
                    $("#tb_tl").empty();
                    $("#tb_tl").html(data);
                }
            });

        });

        // TAT DIALOG
        $(document).on('click','#modalForm .loc-cancel',function (e) {
            alertify.genericDialog().close();
            $('#modalForm').hide();
        }); 

//  TIEN HANH TIM KIEM THEO YEU CAU
   
</script>
@endsection