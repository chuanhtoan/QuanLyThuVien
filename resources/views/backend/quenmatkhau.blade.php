<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V19</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--===============================================================================================-->

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />

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
    <style>
        .wrap-input100 {
            margin-bottom: 1rem !important;
        }
    </style>
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
            <form class="login100-form validate-form" method="post" action="{{route('admin.postQuenMK')}}">
                    @csrf
                    <span class="login100-form-title p-b-33">
                        Quên tài khoản
                    </span>

                    <div class="wrap-input100">
                        <input class="input100" required type="text" name="tenTaiKhoan" placeholder="Tên tài khoản">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                
                    <div class="wrap-input100">
                        <input class="input100" id="password" required type="password" name="pass"
                            placeholder="Password mới">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="wrap-input100">
                        <input class="input100" required type="password" name="pass_comfirm"
                            placeholder="Nhập lại Password">
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-20">
                        <button type="submit" class="login100-form-btn">
                            Gửi mail
                        </button>
                    </div>

                   

                   
                </form>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->

    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <script type="text/javascript"
        src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
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
    
    <script>
// ============== VALIDATE FORM



$.validator.addMethod("kiemTraTonTai", function (value, element, params) {
        var kt =  false;
        var kttaikhoan = "/admin/kttaikhoan/" + value;
        console.log('safd');
        $.ajax({
            url: kttaikhoan,
            type: 'get',
            async: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (data) {
                if (data['yes'] == true) {
                    kt= true;
                }
            }
        });
        // console.log(data_);
        return kt;
    });


  $(".validate-form").validate({
        onfocusout: function (element) {
            if ($(element).val() == "") return;
            var hl = $(element).valid();
            if (hl) {

                if ($(element).hasClass('is-invalid'))
                    $(element).removeClass("form-control is-invalid");
                $(element).addClass('form-control is-valid');
            }
        }, onkeyup: false,
        rules: {
            password: {
                required: true,
                minlength: 5,
            },
            pass_comfirm: {
                required: true,
                equals: '#password',
            },
            tenTaiKhoan: {
                required:true,
                kiemTraTonTai:true
            }
        },
        messages: {
            password: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 5 kí tự',
            },
            pass_comfirm: {
                required: 'Không được bỏ trống',
                equals: 'Nhập lại không đúng mật khẩu',
                
            },
            tenTaiKhoan: {
                required:'Không được bỏ trống',
                kiemTraTonTai:'Tài khoản ko tồn tại'
            }
        },  errorPlacement: function (err, elemet) {
        err.insertBefore(elemet);
        err.addClass('invalid-feedback');
        elemet.addClass('form-control is-invalid');
        elemet.parent().addClass('border-0');
        $('.focus-input100-1,.focus-input100-2').addClass('hidden');
    }, submitHandler: function (form) {
        alertify.success('gửi email thành công');
        setTimeout(function () {
           
            form.submit();
        }, 1000
        );
    }
}
);


    </script>



</body>

</html>