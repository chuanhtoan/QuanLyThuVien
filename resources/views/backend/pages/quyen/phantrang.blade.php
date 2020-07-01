@php ($index = ($page-1)*5 +1)
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>MÃ QUYỀN</th>
            <th>TÊN QUYỀN</th>
            <th>MÔ TẢ</th>
            <th>THAO TÁC</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($arr as $item)
        <tr>
            <td>{{$index++}}</td>
            <td class="txt-oflo">{{$item->id}} </td>
            <td class="txt-oflo">{{$item->maQuyen}} </td>
            <td class="txt-oflo">{{$item->tenQuyen}} </td>
            <td class="txt-oflo">{{$item->moTa}} </td>
            <td>
            <a href="{{route('quyen.edit',$item->id ) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example" style="text-align: center">
    {!!$arr->links()!!}
</nav>