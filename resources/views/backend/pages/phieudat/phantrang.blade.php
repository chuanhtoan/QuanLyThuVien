@php ($index = ($page-1)*5 +1)
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>NGÀY LẬP</th>
            <th>ID ĐỘC GIẢ</th>
            <th>ID NHÂN VIÊN</th>
            <th>CÒN TÁC DỤNG</th>
            <th>THAO TÁC</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($arr as $item)
        <tr>
            <td>{{$index++}}</td>
            <td class="txt-oflo">{{$item->id}} </td>
            <td class="txt-oflo">{{$item->ngayLap->format('d-m-Y')}}</td>
            <td class="txt-oflo">{{$item->docgia()->first()->hoTen}} </td>
            <td class="txt-oflo">{{$item->nhanvien()->first()->hoTen}} </td>
            <td class="txt-oflo">{{$item->daSuDung == true ? 'Hết hiệu lực':'Còn hiệu lực'}} </td>
            <td>
            <a href="{{route('phieudat.edit',$item->id ) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example" style="text-align: center">
    {!!$arr->links()!!}
</nav>