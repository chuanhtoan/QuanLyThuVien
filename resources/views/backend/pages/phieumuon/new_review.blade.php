<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Review</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>

        .logo{
            float: left;
            width: 90px;
        }
        #block-ma-phieu{
            float: right;
            border: 0.7px black solid;
            width: 180px;
            margin-top: 15px;
        }  

        #block-ma-phieu p{
            text-transform: uppercase;
            text-align: center;
            margin: 0;
        }

        #block-ma-phieu #t-ma-phieu{
            font-weight: bolder;
        } 
       



        .head-chitiet{
            overflow: hidden;
        }
        #title{
            margin-top: 10px;
            text-align: center;
            text-transform: capitalize;
            text-transform: uppercase;
            font-weight: bolder;
            font-size: 20px;
        }

        .container{
            width: 500px;
            margin: 0 auto;
            border: 1px solid black;
            padding: 5px 20px;
        }

        .body .block{
            margin-top: 7px;
        }

        .body .title-ct{
            font-weight: bold;
            width: 25%;display: inline-block;
        }
        .body .noi-dung{
            font-weight: bold;
            width: 50%;display: inline-block;
            border-bottom: dotted 1px black;
        }

        .footer ul {
            font-weight: bold;
        }
        .footer ul li{
           font-style: italic;
           font-size: 0.8rem;
        }
        .table th{
            font-size: 0.9rem;
            font-weight: normal;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="print-conatainer">
            <div class="head">
                <div class="head-chitiet">
                   <div>
                       <img class="logo" src="{{asset('img/website/logo.png')}}" alt="logo-yoyobook">
                   </div>
                   <div id = 'block-ma-phieu'>
                       <p id="t-ma-phieu">
                           Mã phiếu mượn
                       </p>
                       <p id='ma-phieu'>
                          ..................
                       </p>
                   </div>
                </div>
                <div id = 'title'>
                      Phiếu Mượn sách
                </div>


            </div>

            <div class="body">
                <div class = 'block'>
                    <span class = 'title-ct' >Họ và tên:</span>
                    <span class="noi-dung"></span>
                </div>

                <div class = 'block'>
                    <span class = 'title-ct' >Nhân viên:</span>
                    <span class="noi-dung"></span>
                </div>

                <div class = 'block'>
                    <span class = 'title-ct'>Mượn từ ngày:</span>
                    <span>...............</span>
                    <span class = 'title-ct'>đến ngày:</span>
                    <span>..............</span>
                </div>

                <div class = 'block'>
                    <span class = 'title-ct'>Số lượng sách:</span>
                    <span class="noi-dung"></span>
                    <span>Cuốn</span>
                </div>

                <div class = 'block'>
                    <span class = 't-b'>Chi tiết phiếu mượn:</span>
                    <table class="table table-bordered " id='table-chitiet'>
                        <thead>
                            <tr>
                                <th>MÃ CUỐN SÁCH</th>
                                <th>TÊN SÁCH</th>
                            </tr>
                        </thead>
                        <tbody>
                              @for ($i = 0;$i<7;$i++)
                              <tr>
                                    <td class="txt-oflo">........................</td>
                                    <td class="txt-oflo">...................................</td>
                              </tr>
                              @endfor
                        </tbody>
                    </table>
                </div>

            </div>

            <div class = 'footer'>
                <ul>
                    Lưu ý:
                    <li>Quý khách phải trả sách đúng ngày hẹn, nếu trả trễ sẽ chịu phạt(1.000 đồng/ngày)</li>
                    <li>Tiền phạt khi làm mất sách là 50% giá của cuôn sách bị mất</li>
                    <li>Quý khách chỉ được mượn tối đa 7 cuốn sách</li>
                    <li>Quý khách vui lòng giữ lại phiếu này</li>
                </ul>
            </div>
        </div>
    </div>
    

         
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
          $(document).ready(function () {
              window.print();
          });
    </script>
</body>
</html>