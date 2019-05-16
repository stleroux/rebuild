<div class="text-center">
   <div class="btn-group" role="group">
      @if(Request::route('cat') == 'all')
         <a href="{{ route(str_plural($model) . '.index', 'all') }}"
            class="{{ Request::is(str_plural($model) . '/' . 'all') ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route(str_plural($model) . '.index', ['all', $value]) }}"
               class="{{ Request::is(str_plural($model) . '/all/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      @else
         <a href="{{ route(str_plural($model) . '.index', Request::route('cat')) }}"
            class="{{ Request::is(str_plural($model) . '/' . Request::route('cat'), Request::route('key')) ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route(str_plural($model) . '.index', [Request::route('cat'), $value]) }}"
               class="{{ Request::is(str_plural($model) . '/' . Request::route('cat') . '/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      @endif
   </div>
</div>