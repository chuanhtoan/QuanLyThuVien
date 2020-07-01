@php ($index = ($page-1)*5 +1)
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>TÊN SÁCH</th>
            <th>TÁC GIẢ</th>
            <th>THỂ LOẠI</th>
            <th>NHÀ XUẤT BẢN</th>
            <th>GIÁ BÁN</th>
            <th>CHO PHÉP MƯỢN</th>
            <th>THAO TÁC</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($arr as $item)
        <tr>
            <td>{{$index++}}</td>
            <td class="txt-oflo">{{$item->id}} </td>
            <td>{{$item->tenSach}}</td>
            <td class="txt-oflo">{{$item->hoTen}} </td>
            <td class="txt-oflo">{{$item->tenTheLoai == "" ? "Chưa rõ":$item->tenTheLoai}} </td>
            <td class="txt-oflo">{{$item->tenNXB == "" ? "Chưa rõ":$item->tenNXB}} </td>
            <td class="txt-oflo">{{$item->gia == "" ? "Chưa rõ":$item->gia}} </td>
            <td class="txt-oflo">{{$item->duocPhepMuon == "" ? "Chưa":"Được"}} </td>
            
            <td>
                <a href="{{route('sach.edit',$item->id ) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                <a href="{{route('sach.review',$item->id ) }}"><button type="button" value="{{$item->id}}" class="soan btn btn-primary">Soạn bài</button></a>

                <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



<nav aria-label="Page navigation example" style="text-align: center">
    {!!$arr->links()!!}
</nav>