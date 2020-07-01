<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="HLinh">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('backend/plugins/images/favicon.png')}}">
    <title>Ample Admin Template - The Ultimate Multipurpose admin template</title>
    
    

    @include('backend.elements.header')

    
   
</head>
<body>
    <!-- Preloader -->
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center ">
                <h3 class="text-uppercase font-roboto">{{$info}}</h3>
                <a href="{{route('admin.login')}}" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">Hoặc về đăng nhập</a> </div>
            <footer class="footer text-center">2017 © Ample Admin.</footer>
        </div>
    </section>
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
