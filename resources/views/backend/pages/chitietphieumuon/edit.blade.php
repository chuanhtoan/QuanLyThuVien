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
                <h4 class="page-title">Phieu Muon</h4>
            </div>
        </div>

        <div class="white-box">
            <form id="chitietphieumuonForm" action="{{route('chitietphieumuon.store')}}" method="post">
                {{ method_field('PUT') }}
                @csrf
               
                {{-- Nhap ten the loai --}}
                <div>
                    <label>Chi Tiết Phiếu Mượn: {{$itemctpm->id}}</label>
                </div>
                
                <div style="display: flex;">
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="selectCuonSach">Cuốn sách</label>
                    <select class="form-control" id="selectCuonSach" name="selectCuonSach" required>
                            <option value="" disabled selected>Chọn cuốn sách</option>
                            @foreach($itemcuonsach as $item)
                            <option value="{{$item->id}}">{{$item->id}}</option>
                            @endforeach
                    </select>
                </div>


                
            </div>
                {{-- Bat Dau chon the loai cha--}}
                


                <div class="text-center" style="margin-top: 5rem;">
                    <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                    <button type="button" id="check" class="btn btn-primary">Lưu</button>
                    <a href="{{route('chitietphieumuon.show',$itemctpm->ID_PhieuMuon)}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost='/admin/danhmuc/chitietphieumuon';
    $("#check").click(function () {
        var hl = $("#chitietphieumuonForm").valid();
        var href =   window.location;
        var id =href.toString().split('chitietphieumuon/')[1].split('/')[0] ;
        if (hl) {
            thucHienAjax(id);
        }
    });

    // $("#chitietphieumuonForm").validate({
    //     onfocusout: function (element) {
    //         if ($(element).val() == "") return;
    //         var hl = $(element).valid();
    //         if (hl) {

    //             if ($(element).hasClass('is-invalid'))
    //                 $(element).removeClass("form-control is-invalid");
    //             $(element).addClass('form-control is-valid');
    //         }
    //     }, onkeyup: false,
    //     rules:
    //         ngayMuon: {
    //             required:true
    //         },
    //     },
    //     messages: {
    //         ngayMuon: {
    //             required:'Không được bỏ trống'
    //         },
    //     }, errorPlacement: function (err, elemet) {
        
    //     err.insertAfter(elemet);    
    //     err.addClass('invalid-feedback d-inline text-danger');
    //     elemet.addClass('form-control is-invalid');
    //     $('.focus-input100-1,.focus-input100-2').addClass('hidden');
    // }
    //});
    
    function thucHienAjax(id) {
        var obj = {
            'ID_CuonSach': $("#selectCuonSach").children('option:selected').val(),
        };
        console.log(obj);
        
        $.ajax({
            type: "post",
            method:'put',
            url: urlPost+'/'+id,
            data: obj,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                if (response.yes === true) {
                    alertify.success('Sửa chi tiết phiếu mượn thành công');
                }
            }
        });
    }



</script>
@endsection