{{-- <div class="text-center">
   <div class="btn-group" role="group">
      @if($page == 'index')
         <a href="{{ route(str_plural($model) . '.' . Session::get('pageName')) }}"
            class="{{ Request::is(str_plural($model)) ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route(str_plural($model) . '.' . Session::get('pageName'), $value) }}"
               class="{{ Request::is(str_plural($model) . '/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      @else
         <a href="{{ route(str_plural($model) .'.' . Session::get('pageName')) }}"
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
 --}}

 {{-- ALPHABET START --}}
@if($page == 'index')
   <div class="text-center">
      <div class="btn-group" role="group">
         <a href="{{ route($model.'s.index') }}"
            class="{{ Request::is($model.'s') ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route($model.'s.index', $value) }}"
               class="{{ Request::is($model.'s/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      </div>
   </div>
@else
   <div class="text-center">
      <div class="btn-group" role="group">
         <a href="{{ route($model.'s.'.$page) }}"
            class="{{ Request::is($model.'s/' . $page) ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route($model.'s.' . $page, $value) }}"
               class="{{ Request::is($model.'s/' . $page . '/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      </div>
   </div>
@endif
{{-- ALPHABET END --}}
