<tr>
    <td class="txt-oflo">{{$item->hienThi}}</td>
    <td class="txt-oflo">{{$item->sach()->first()->tenSach}}</td>
    <td>
        <button type="button" value = {{$item->hienThi}} 
        class="form-control xoa btn btn-danger" style="width: 40%;color:white;">Xóa</button>
    </td>
</tr>