<div class="text-center pb-2">
   <div class="btn-group" role="group">
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
         <a href="{{ route(Session::get('fromLocation')) }}"
            class="{{ Request::is(str_replace('.', '/', Session::get('fromLocation'))) ? "btn-secondary": "btn-primary" }} btn btn-sm"
         >
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route(Session::get('fromLocation'), $value) }}"
               class="{{ Request::is(str_replace('.', '/', Session::get('fromLocation')) . '/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm"
            >
               {{ strtoupper($value) }}
            </a>
         @endforeach
      {{-- @endif --}}
   </div>
</div>

{{-- {{str_replace('_', ' ', $str)}} --}}