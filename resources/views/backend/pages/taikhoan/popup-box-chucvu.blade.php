<div class='box'>
    <div class='pupup-box-header'>
        <p class='popup-box-exit'>X</p>
        <p class='title'>Thêm chức vụ</p>
    </div>
    <div class='noi-dung'>
    <p>Bạn hãy chọn một chúc vụ:</p>
   
        @if (count($arr) == 0)
            <p>Đã hết chức vụ rồi !!!</p>
        @else
           <select name='chucvu' id='select-chuc-vu'>
               @foreach ($arr as $item)
                   <option value="{{$item['id']}}">{{$item['tenChucVu']}}</option>
              @endforeach
            </select>
        @endif 
       
 
    <button class='ok-chuc-vu'>OK</button>
    </div>
</div>