<div class="text-center">
   <div class="btn-group" role="group">
      {{-- @if($request->cat == 'all') --}}
         <a href="{{ route(str_plural($model) . '.' . Session::get('pageName'), 'all') }}"
            class="{{ Request::is(str_plural($model) . '/' . 'all') ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route(str_plural($model) . '.' . Session::get('pageName'), ['all', $value]) }}"
               class="{{ Request::is(str_plural($model) . '/all/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      {{-- @else --}}
      {{-- @endif --}}
   </div>
</div>