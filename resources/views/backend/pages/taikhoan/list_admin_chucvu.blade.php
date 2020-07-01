@foreach ($data->chucvus()->get() as $item)
@include('backend.pages.taikhoan.admin_chucvu',['item'=>$item])
@endforeach