@php ($index = ($page-1)*5 +1)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>TÊN NHÂN VIÊN</th>
                                <th>CHỨC VỤ</th>
                                <th>NĂM SINH</th>
                                <th>CMND</th>
                                <th>ĐỊA CHỈ</th>
                                <th>SỐ ĐIỆN THOẠI</th>
                                <th>Giới tính</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($arr as $item)
                            <tr>
                                <td>{{$index++}}</td>
                                <td class="txt-oflo">{{$item->id}} </td>
                                <td class="txt-oflo">{{$item->hoTen}} </td>
                                <td class="txt-oflo">{{$item->chucVu}} </td>
                                <td class="txt-oflo">{{$item->namSinh}} </td>
                                <td class="txt-oflo">{{$item->cmnd}} </td>
                                <td class="txt-oflo">{{$item->diaChi}} </td>
                                <td class="txt-oflo">{{$item->sdt}} </td>
                                <td class="txt-oflo">{{$item->gioiTinh == true ? "Nam":"Nữ"}} </td>
                                <td>
                                <a href="{{route('nhanvien.edit',$item->id ) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                                    <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example" style="text-align: center">
                        {!!$arr->links()!!}
                    </nav>