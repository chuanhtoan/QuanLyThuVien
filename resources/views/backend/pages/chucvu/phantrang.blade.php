@php ($index = ($page-1)*5 +1)
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>TÊN CHÚC VỤ</th>
            <th>THAO TÁC</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($arr as $item)
        <tr>
            <td>{{$index++}}</td>
            <td class="txt-oflo">{{$item->id}}</td>
            <td data-togge="tooltip" data-placement="top" title="Nhấn để xem chi tiết"> 
                <a href="#noi-dung-collapse-{{$item->id}}" class="show-collapse" data-toggle="collapse">{{$item->tenChucVu}}</a>            
                <div class="collapse" id = "noi-dung-collapse-{{$item->id}}">
                    <ul>
                        @foreach ($item->quyens()->get() as $q)    
                        <li>
                            <p>{{$q->tenQuyen}}</p>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </td>                               
            <td>
                <a href="{{route('chucvu.edit',$item->id ) }}"><button type="button" value="{{$item->id}}" class="sua btn btn-primary">Sửa</button></a>
                <button type="button" value="{{$item->id}}" class="xoa btn btn-danger">Xóa</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<nav aria-label="Page navigation example" style="text-align: center">
    {!!$arr->links()!!}
</nav>