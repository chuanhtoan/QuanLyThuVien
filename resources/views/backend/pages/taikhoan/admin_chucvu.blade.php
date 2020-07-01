
    <p>Quyền: {{$item->tenChucVu}}
        <button style="margin-left: 1rem;" class="xoa-quyen font-roboto"
            value="{{$item['id']}}"> Xóa |</button>
        {{-- <a href="#" class="chinh-sua-quyen font-roboto" value="{{$item->id}}"> Sửa |</a> --}}
        <a href="{{route('chucvu.index')}}" class="chi-tiet-quyen font-roboto" value="{{$item['id']}}"> Chi tiết</a>
    </p>

    @foreach ($item->quyens()->get() as $q)
    <li style="display: flex; ">
        <span style="width: 25%; text-align: center;"
            class='ten-quyen'>{{$q->tenQuyen}}</span>
        <span style="width: 70%;">{{$q->moTa}}</span>
    </li>
    @endforeach
    <hr style="background-color: rgb(201, 201, 201)">
