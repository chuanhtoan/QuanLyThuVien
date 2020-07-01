@php ($index = ($page-1)*5 +1)
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>NGÀY LẬP</th>
            <th>NHÂN VIÊN LẬP</th>
            <th>ĐỌC GIẢ</th>
            <th>TIỀN PHẠC</th>
            <th>THAO TÁC</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($arr as $item)
        <tr>
            <td>{{$index++}}</td>
            <td class="txt-oflo">{{$item->id}} </td>
            <td class="txt-oflo">{{$item->ngayLap->format('d-m-Y')}}</td>
            <td class="txt-oflo">{{$item->nhanvien()->first()->hoTen}} </td>
            <td class="txt-oflo">{{$item->phieumuon()->first()->docgia()->first()->hoTen}} </td>
            <td class="txt-oflo">{{$item->tienPhat}} VND </td>
            <td>
                {{-- <a href="{{route('chitietphieumuon.show',$item->id) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Xem</button></a> --}}
                <a href="{{route('vipham.edit',$item->id) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<nav aria-label="Page navigation example" style="text-align: center">
    {!!$arr->links()!!}
</nav>