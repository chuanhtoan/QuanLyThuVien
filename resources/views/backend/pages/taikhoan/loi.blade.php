@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    .myRadio span {
        margin-left: 1.5rem;
    }

    /* HET CHECK BOX */
    body {
        font-family: 'Muli', sans-serif;
    }

    .white-box label {
        font-weight: bold;
    }

 


    /*  END POPUP BOX */
</style>
@endsection
{{-- {{$html}} --}}

@section('noi-dung')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title font-noto">Cá nhân/Tài khoản</h4>
            </div>
        </div>
        {{-- {{dd($data)}} --}}
        <div class="row">
            <div class="white-box " style="padding-left: 5rem; overflow: hidden;">
               
                <div style="width: 50%; margin: 0 auto;"> 
                    <p style="text-align: center">{{$loi}}</p>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
@section('footer')
@parent
<script>
  
  

   
</script>
@endsection

