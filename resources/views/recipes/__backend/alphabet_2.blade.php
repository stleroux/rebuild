<div class="text-center">
   <div class="btn-group" role="group">
      @if(Request::route('cat') == 'all')
         <a href="{{ route(str_plural($model) . '.' . Session::get('fromPage')) . '/all'}}"
            class="{{ Request::is(str_plural($model) . '/' . Session::get('fromPage')) . '/all' ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route(str_plural($model) . '.' . Session::get('fromPage')) }}"
               class="{{ Request::is(str_plural($model) . Session::get('fromPage') . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      @else
         <a href="{{ route(str_plural($model) . '.' . Session::get('fromPage')) }}"
            class="{{ Request::is(str_plural($model) . '/' . Session::get('fromPage')) ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route(str_plural($model) . '.' . Session::get('fromPage'), $value) }}"
               class="{{ Request::is(str_plural($model) . '/' . Session::get('fromPage') . '/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      @endif
   </div>
</div>