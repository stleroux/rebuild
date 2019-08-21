{{-- <div class="text-center pb-2">
   <div class="btn-group" role="group"> --}}
      {{-- @if(Request::route('cat') == 'all')
         <a href="{{ route(Session::get('fromPage')) }}"
            class="{{ Request::is(Session::get('fromPage')) ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route(Session::get('fromPage')) }}"
               class="{{ Request::is(Session::get('fromPage') . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      @else --}}
{{--          <a href="{{ route('posts.'.Session::get('fromLocation')) }}"
            class="{{ request::is('posts.'.Session::get('fromLocation')) ? "btn-secondary": "btn-primary" }} btn btn-sm"
         >
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route('posts.'.Session::get('fromLocation'), $value) }}"
               class="{{ route::is('posts.'.Session::get('fromLocation') . '.' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm"
            >
               {{ strtoupper($value) }}
            </a>
         @endforeach --}}
      {{-- @endif --}}
{{--    </div>
</div> --}}

{{-- {{str_replace('_', ' ', $str)}} --}}


<div class="text-center">
   <div class="btn-group" role="group">
      <a href="{{ route('posts.index') }}"
         class="{{ Request::is('posts') ? "btn-secondary": "btn-primary" }} btn btn-sm">
         All
      </a>
      @foreach($letters as $value)
         <a href="{{ route('posts.index', [$value]) }}"
            class="{{ Request::is('posts' . '/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
            {{ strtoupper($value) }}
         </a>
      @endforeach
   </div>
</div>