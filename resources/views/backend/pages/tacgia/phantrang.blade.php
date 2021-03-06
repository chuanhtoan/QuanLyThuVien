@php ($index = ($page-1)*5 +1)
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>TÊN TÁC GIẢ</th>
            <th>NĂM SINH</th>
            <th>NĂM MẤT</th>
            <th>QUỐC TỊCH</th>
            <th>THAO TÁC</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($arr as $item)
        <tr>
            <td>{{$index++}}</td>
            <td class="txt-oflo">{{$item->id}} </td>
            <td>{{$item->hoTen}}</td>
            <td class="txt-oflo">{{$item->namSinh}} </td>
            <td class="txt-oflo">{{$item->namMat == "" ? "Chưa rõ":$item->namMat}} </td>
            <td class="txt-oflo">{{$item->quocTich == "" ? "Chưa rõ":$item->quocTich}} </td>
            <td>
            <a href="{{route('tacgia.edit',$item->id ) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example" style="text-align: center">
    {!!$arr->links()!!}
</nav>