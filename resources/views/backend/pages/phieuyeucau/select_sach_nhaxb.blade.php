@foreach ($item->sachs()->get() as $it)
   <option value="{{$it->id}}">{{$it->tenSach}}</option>    
@endforeach