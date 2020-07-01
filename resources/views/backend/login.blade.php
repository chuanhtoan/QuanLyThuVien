<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V19</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!-- Font awesome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css ')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/animate/animate.css ')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/css-hamburgers/hamburgers.min.css ')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/animsition/css/animsition.min.css ')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/select2/select2.min.css ')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/vendor/daterangepicker/daterangepicker.css ')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login/css/util.css ')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login/css/main.css ')}}">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">

               
                <form class="login100-form validate-form" method="POST" action="{{route('admin.postLogin')}}">
                    @csrf
                    <span class="login100-form-title p-b-33">
                        Account Login
                    </span>
                     @if (isset($error))
                       <div class="text-danger">Tài khoản hoặc mật khẩu sai</div>
                    @endif
                    
                    <div class="wrap-input100">
                        <input class="input100" type="text" name="tenTaiKhoan" placeholder="Tên tài khoản">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="wrap-input100 rs1">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-20">
                        <button class="login100-form-btn">
                            Sign in
                        </button>
                    </div>

                    <div class="text-center p-t-45 p-b-4">
                        <span class="txt1">
                            Bạn quên
                        </span>

                        <a href="{{route('admin.quenMK')}}" class="txt2 hov1">
                            Tài khoản / Mật khẩu?
                        </a>
                    </div>

                    {{-- <div class="text-center">
                        <span class="txt1">
                            Tạo tài khoản mới?
                        </span>

                        <a href="{{route('admin.register')}}" class="txt2 hov1">
                            đăng ký nhé
                        </a>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <!--===============================================================================================-->
    <script src="{{asset('login/vendor/animsition/js/animsition.min.js ')}}"></script>

    <!--===============================================================================================-->
    <script src="{{asset('login/vendor/select2/select2.min.js ')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('login/vendor/daterangepicker/moment.min.js ')}}"></script>
    <script src="{{asset('login/vendor/daterangepicker/daterangepicker.js ')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('login/vendor/countdowntime/countdowntime.js ')}}"></script>
    <!--===============================================================================================-->
    {{-- <script src="{{asset('login/js/main.js')}}"></script> --}}



</body>

</html>