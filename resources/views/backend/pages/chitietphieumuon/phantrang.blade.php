@php ($index = ($page-1)*5 +1)
<table class="table">
    <thead>

        <tr><td>PHIẾU MƯỢN: {{$arr[0]->idphieumuon}}</td></tr>
        <tr><td>NGÀY MƯỢN: {{$arr[0]->ngayMuon}}</td></tr>
        <tr><td>NGÀY HẸN TRẢ: {{$arr[0]->ngayHenTra}}</td></tr>
        <tr><td>TÊN NHÂN VIÊN: {{$arr[0]->tenNhanVien}}</td></tr>
        <tr><td>TÊN ĐỘC GIẢ: {{$arr[0]->tenDocGia}}</td></tr>

        <tr>
            <th>#</th>
            <th>ID</th>
            <th>MÃ CUỐN SÁCH</th>
            <th>TÊN SÁCH</th>
            <th>THAO TÁC</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($arr as $item)
        <tr>
            <td>{{$index++}}</td>
            <td class="txt-oflo">{{$item->id}} </td>
            <td class="txt-oflo">{{$item->idcuonsach}} </td>
            <td class="txt-oflo">{{$item->tenSach}} </td>
            <td>
            <a href="{{route('chitietphieumuon.edit',$item->id ) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<nav aria-label="Page navigation example" style="text-align: center">
    {!!$arr->links()!!}
</nav>