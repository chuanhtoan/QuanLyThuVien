
    <table class="table" >
        <thead>
            <tr>
                <th>STT</th>
                <th>MÃ</th>
                <th>TÊN THỂ LOẠI</th>
                <th>ID THỂ LOẠI CHA</th>
                <th>THAO TÁC</th>  
            </tr>
        </thead>
        @php ($index = ($page-1)*5 +1)
        <tbody>
            
            @foreach ($arr as $item)  
            <tr>
                <td>{{$index++}}</td>
                <td class="txt-oflo">{{$item->id}} </td>
                <td>{{$item->tenTheLoai}}</td>
                <td class="txt-oflo">{{$item->ID_Cha}} </td>
                <td>
                    <a  href="{{route('theloai.edit',$item->id)}}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                    <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <nav aria-label="Page navigation example" style="text-align: center">
        {!!$arr->links()!!}  
    </nav>