
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="#sach-collect"  data-toggle="collapse" class="active waves-effect font-muli text-b" aria-controls="navbar">
                            <i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Sách
                        </a>
                        <div class="collapse in" id="sach-collect">
                        <ul class="nav nav-bar">
                            <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('sach.index')}}">Sách</a></li>
                            <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('theloai.index')}}">Thể loại</a></li>
                            <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('tacgia.index')}}">Tác giả</a></li>
                            <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('nxb.index')}}">Nhà xuất bản</a></li>
                        </ul>
                    </div>
                    </li>

                    <li>
                        <a href="#nhap" data-toggle="collapse" class="waves-effect font-muli text-b"><i class="fa fa-columns fa-fw" aria-hidden="true"></i>Nhập kho</a>
                        <div class="collapse" id="nhap">
                            <ul  class="nav nav-bar" >
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('phieuyeucau.index')}}">Phiếu yêu cầu</a></li>
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('phieunhap.index')}}">Phiếu nhập</a></li>
                            </ul>
                            </div>
                    </li>
                    <li>
                        <a href="{{route('nhanvien.index')}}" class="waves-effect font-muli text-b"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>Nhân sự</a>
                    </li>

                    <li>
                        <a href="#somuon" data-toggle="collapse" class="waves-effect font-muli text-b"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Sổ mượn</a>
                        <div class="collapse" id="somuon">
                            <ul  class="nav nav-bar" >
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('phieumuon.create')}}">Tạo phiếu mượn</a></li>
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('phieumuon.index')}}">Danh Sách</a></li>
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('phieumuon.new_review')}}" target="_blank">Xuất phiếu</a></li>
                            </ul>
                            </div>
                    </li>
                    <li>
                        <a href="{{route('phieutra.index')}}" class="waves-effect font-muli text-b"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Sổ trả</a>
                    </li>
                    <li>
                        {{-- <a href="fontawesome.html" class="waves-effect font-muli text-b"><i class="fa fa-font fa-fw" aria-hidden="true"></i></a> --}}
                        <a href="#vipham" data-toggle="collapse" class="waves-effect font-muli text-b"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Biên bản</a>
                        <div class="collapse" id="vipham">
                            <ul  class="nav nav-bar" >
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('vipham.create')}}">Tạo biên bản</a></li>
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('vipham.index')}}">Danh Sách</a></li>
                            </ul>
                            </div>
                    </li>
                    <li>
                        <a href="{{route('docgia.index')}}" class="waves-effect font-muli text-b"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>Độc giả</a>
                    </li>
                    <li>
                        <a href="#tkvaq" data-toggle="collapse" class="waves-effect font-muli text-b"><i class="fa fa-columns fa-fw" aria-hidden="true"></i>Quyền và tài khoản</a>
                        <div class="collapse" id="tkvaq">
                            <ul  class="nav nav-bar" >
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('taikhoan.index')}}">Tài khoản</a></li>
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('chucvu.index')}}">Chúc vụ</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#thongke" data-toggle="collapse" class="waves-effect font-muli text-b"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Thống kê</a>
                        <div class="collapse" id="thongke">

                        <ul  class="nav nav-bar" >
                            <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="#">Theo sản phẩm</a></li>
                            <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="#">Theo số lượng</a></li>
                            <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="#">Theo đọc giả</a></li>
                        </ul>
                        </div>
                    </li>
                    <li class="mb-4">
                        <a href="#canhan" data-toggle="collapse" class="waves-effect font-muli text-b"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i>Cá nhân</a>
                        <div class="collapse" id="canhan">
                            <ul  class="nav nav-bar" >
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('taikhoan.show',['taikhoan'=>Auth::guard('admin')->user()->id])}}">Tài khoản</a></li>
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('taikhoan.nhanvien',['id'=>Auth::guard('admin')->user()->id] )}}">Thông tin cá nhân</a></li>
                                <li class = "nav-item"><a class = "font-muli pdleft-5rem hover-gray nav-link" href="{{route('taikhoan.logout')}}" >Đăng xuất</a></li>
                            </ul>
                        </div>
                    </li>
                    

                </ul>
                {{-- <div class="center p-20">
                     <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger btn-block waves-effect font-muli text-b waves-light">Upgrade to Pro</a>
                 </div> --}}
            </div>
            
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->

     
       