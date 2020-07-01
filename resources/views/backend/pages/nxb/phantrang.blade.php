@php ($index = ($page-1)*5 +1)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>TÊN NXB</th>
                                <th>SDT</th>
                                <th>EMAIL</th>
                                <th>THAO TÁC</th>
                            </tr>
                        </thead>
                        <tbody>
    
                            @foreach ($arr as $item)
                            <tr>
                                <td>{{$index++}}</td>
                                <td class="txt-oflo">{{$item->id}} </td>
                                <td>{{$item->tenNXB}}</td>
                                <td class="txt-oflo">{{$item->tenNXB}} </td>
                                <td class="txt-oflo">{{$item->email}} </td>
                                <td class="txt-oflo">{{$item->sdt}} </td>
                                <td>
                                <a href="{{route('nxb.edit',$item->id ) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                                    <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
    
                    <nav aria-label="Page navigation example" style="text-align: center">
                        {!!$arr->links()!!}
                    </nav>
