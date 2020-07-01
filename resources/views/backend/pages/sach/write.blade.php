@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    /* CUSTOM CHECBOX */
   

    .myRadio span {
        margin-left: 1.5rem;
    }

    .theLoai {
        padding-left: 1rem !important;
    }

    .text-title {
        text-transform: uppercase;
        font-weight: bold;
        display: inline-block;
        margin-right: 0.5rem;
        color: black;
    }

    /* CUSTOM CHECBOX */


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
        @include('backend.pages.sach.page-title')
        
        <div class="white-box">
            <p id="title_" style="font-weight: bolder;font-size: 2rem;margin-bottom: 1rem;">
            Bài viết review                  
        </p> 
            <form id="sachForm" action="{{route('sach.write',$id)}}" method="post" enctype="multipart/form-data">
                @csrf
                              
                  
                <textarea name="review" class="ckeditor" id="review" placeholder="Viết bài review">
                    {!!$dulieu!!}
                </textarea>




                <div class="text-center" style="margin-top: 5rem;">
                    <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                    <button type="button" id="check" class="btn btn-primary">Lưu</button>
                    <a href="{{route('sach.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
                </div>
               <div id="kq">

               </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
<script>
 $('#check').click(function(){
    // $('#kq').html($('review').text());
    // var text= CKEDITOR.instances['review'].getData();

    $('#sachForm').submit();
 });  
   
    
</script>
@endsection