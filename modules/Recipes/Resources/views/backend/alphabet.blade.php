wqwqwq<div class="text-center">
   <div class="btn-group" role="group">
      @if(Request::route('cat') == 'all')
         <a href="{{ route(str_plural($model) . '.' . Session::get('pageName')) }}"
            class="{{ Request::is(str_plural($model) . '/' . Session::get('pageName')) ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route(str_plural($model) . '.' . Session::get('pageName')) }}"
               class="{{ Request::is(str_plural($model) . Session::get('pageName') . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      @else
         <a href="{{ route(str_plural($model) . '.' . Session::get('pageName')) }}"
            class="{{ Request::is(str_plural($model) . '/' . Session::get('pageName')) ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route(str_plural($model) . '.' . Session::get('pageName'), $value) }}"
               class="{{ Request::is(str_plural($model) . '/' . Session::get('pageName') . '/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      @endif
   </div>
</div>