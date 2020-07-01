@php ($index = ($page-1)*5 +1)
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>PHIẾU MƯỢN</th>
            <th>NGÀY TRẢ</th>
            <th>NHÂN VIÊN</th>
            <th>THAO TÁC</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($arr as $item)
        <tr>
            <td>{{$index++}}</td>
            <td class="txt-oflo">{{$item->id}} </td>
            <td class="txt-oflo">{{$item->idphieumuon}} </td>
            <td class="txt-oflo">{{$item->ngayTra->format('d-m-Y')}}</td>
            <td class="txt-oflo">{{$item->tenNhanVien}} </td>
            <td>
            <a href="{{route('phieutra.edit',$item->id ) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example" style="text-align: center">
    {!!$arr->links()!!}
</nav>