

    <form id="modalForm" action="{{route('sach.loc-kq')}}" method="GET" class="text-center d-none">
        <table style="width: 80%;margin: 0 auto;">
            <tr>
                <td for='id' class="title-loc"><label  > ID </label></td>   
                <td class="body-loc"><input id = 'id' name=id type="text" value="" /></td>
            </tr>
            <tr>
                <td for='tenSach' class="title-loc"  ><label> Tên sách </label></td>   
                <td class="body-loc"><input id='tenSach' name="tenSach" type="text" value="" /></td>
            </tr>

            <tr>
                <td for='tacGia' class="title-loc"  ><label> Tác giả </label></td>   
                <td class="body-loc"><input id = 'tacGia' name='tacGia' type="text" value="" /></td>
            </tr>

            <tr>
                <td class="title-loc" for='theLoai' ><label> Thể loại </label></td>   
                <td class="body-loc"><input name='theLoai' id = 'theLoai' type="text" value="" /></td>
            </tr>

            <tr>
                <td class="title-loc" for='nxb' ><label> Nhà xuất bản </label></td>   
                <td class="body-loc"><input name="nxb" type="nxb" type="text" value="" /></td>
            </tr>

            <tr>
                <td class="title-loc" for='duocPhep' ><label> Được phép mượn </label></td>   
                <td class="body-loc">
                    <select name="duocPhep" id="duocPhep">
                        <option value="1">Được phép mượn</option>
                        <option value="0">Không được phép mượn</option>
                    </select>
                </td>
            </tr>

            {{-- <tr>
                <td class="title-loc"><label  for="muonTu"> Ngày mượn từ </label></td>   
                <td class="body-loc">
                    <input type="date" id='muonTu' name="muonTu" value=""/>
                </td>
            </tr>
            <tr>
                <td class="title-loc"><label for='muonDen' >Đến ngày</label></td>   
                <td class="body-loc">
                    <input type="date" id='muonDen' name="muonDen" value=""/>
                </td>
            </tr>
           

            <tr>
                <td class="title-loc"><label for="traTu"  > Ngày trả từ </label></td>   
                <td class="body-loc">
                    <input type="date" id='traTu' name="traTu" value=""/>
                </td>
            </tr>
            <tr>
                <td class="title-loc"><label for='traDen' >Đến ngày</label></td>   
                <td class="body-loc">
                    <input type="date" id='traDen' name="traDen" value=""/>
                </td>
            </tr> --}}
            <tr>
                <td colspan="2" class="text-center">
                    <button type="submit" class="loc-ok btn btn-success" >OK</button>
                    <button type="button" class="loc-cancel btn btn-danger" >Cancel</button>
                </td>
            </tr>
        </table>
    </form>

    