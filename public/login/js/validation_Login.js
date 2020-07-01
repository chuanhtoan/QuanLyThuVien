

// var validation_main = (function () {
//     "use strict";


/*==================================================================
// [ Validate ]*/
// var input = $('.validate-input .input100');

// $('.validate-form').on('submit',function(){
//     var check = true;

//     for(var i=0; i<input.length; i++) {
//         if(validate(input[i]) == false){
//             showValidate(input[i]);
//             check=false;
//         }
//     }

//     return check;
// });


// $('.validate-form .input100').each(function(){
//     $(this).focus(function(){
//        hideValidate(this);
//     });
// });

// function validate (input) {
//     if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
//         if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
//             return false;
//         }
//     }
//     else {
//         if($(input).val().trim() == ''){
//             return false;
//         }
//     }
// }

// function showValidate(input) {
//     var thisAlert = $(input).parent();

//     $(thisAlert).addClass('alert-validate');
// }

// function hideValidate(input) {
//     var thisAlert = $(input).parent();

//     $(thisAlert).removeClass('alert-validate');
// }

$.validator.addMethod('kiemTraTrung',
    function (value, element) {
        var name = $(element).attr('name');
        var dat = {};
        let hopLe = false;
        dat[name] = value;
        console.log(dat);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $.ajax({
            type: "post",
            url: window.location.protocol + "//" + window.location.host + "/admin/valid",
            // url : "{{route('admin.validAdmin')}}",
            data: dat,
            async: false,
            success: function (response) {
                console.log(response);
                if (response.isValid == false) {
                    // console.log('1');
                    hopLe = true;
                }

            }

        });
        // console.log('2');
        // console.log(hopLe);
        return hopLe;

    },
    '');

console.log('validation da chay');


$(".validate-form").validate({
    onfocusout: function (element) {
        if ($(element).val() == "") return;
        var hl = $(element).valid();
        console.log(hl);
        if (hl) {

            if ($(element).hasClass('is-invalid'))
                $(element).removeClass("form-control is-invalid");
            $(element).addClass('form-control is-valid');
        }
    }, onkeyup: false,
    rules: {
        tenTaiKhoan: {
            required: true,
            maxlength: 50,
            minlength: 5,
            kiemTraTrung: true,
        },
        email: {
            required: true,
            email: true,
            kiemTraTrung: true,
        },
        pass: {
            required: true,
            maxlength: 50,
            minlength: 5
        },
        pass_comfirm: {
            required: true,
            equalTo: "#password"
        },
        sdt: 'digits',
        date: 'date',
        namSinh: {
            digits: true,
            min: 1970,
            max: new Date().getFullYear(),
        }
    },
    messages: {
        tenTaiKhoan: {
            required: "Nhập tên tài khoản",
            minlength: "Tên tối thiểu 5 kí tự",
            maxlength: "Tên tối đa 50 kí tự",
            kiemTraTrung: "Tài khoản đã tồn tại"
        },
        email: {
            required: "Nhập email",
            email: "email không hợp lệ",
            kiemTraTrung: "Email đã tồn tại"
        },
        sdt: 'Số điện thoại không hơp lệ',
        date: 'Không đúng định dạng ngày tháng',
        pass: {
            required: "Nhập tên mật khẩu",
            minlength: "Mật khẩu tối thiểu 5 kí tự",
        },
        pass_comfirm: {
            required: "Không được bỏ trống",
            equalTo: "Không đúng mật khẩu"
        }
    },
    errorPlacement: function (err, elemet) {
        err.insertBefore(elemet);
        err.addClass('invalid-feedback');
        elemet.addClass('form-control is-invalid');
        elemet.parent().addClass('border-0');
        $('.focus-input100-1,.focus-input100-2').addClass('hidden');
    }, submitHandler: function (form) {
        alertify.success('Đăng ký thành công');
        setTimeout(function () {
           
            form.submit();
        }, 1000
        );
    }

}
);

// })();