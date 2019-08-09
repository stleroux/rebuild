<div class="text-center">
   <div class="btn-group" role="group">
      @if(Request::route('cat') == 'all')
         <a href="{{ route('recipes.index', 'all') }}"
            class="{{ Request::is('recipes/all') ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route('recipes.index', ['all', $value]) }}"
               class="{{ Request::is('recipes/all/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      @else
         <a href="{{ route('recipes.index', Request::route('cat')) }}"
            class="{{ Request::is('recipes/' . Request::route('cat'), Request::route('key')) ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route('recipes.index', [Request::route('cat'), $value]) }}"
               class="{{ Request::is('recipes/' . Request::route('cat') . '/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      @endif
   </div>
</div>
