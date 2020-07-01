@php ($index = ($page-1)*5 +1)
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>NHÂN VIÊN</th>
            <th>NHÀ XUẤT BẢN</th>
            <th>NGÀY LẬP</th>
            <th>THAO TÁC</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($arr as $item)
        <tr>
            <td>{{$index++}}</td>
            <td class="txt-oflo">{{$item->id}} </td>
            <td class="txt-oflo">{{$item->nhanvien()->first()->hoTen}} </td>
            <td class="txt-oflo">{{$item->nhaXB()->first()->tenNXB}} </td>
            <td class="txt-oflo">{{$item->ngayDat->format('d-m-Y')}}</td>

            <td>
            {{-- <a href="{{route('phieuyeucau.edit',$item->id ) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a> --}}
                <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example" style="text-align: center">
    {!!$arr->links()!!}
</nav>