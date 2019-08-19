@if(checkPerm('recipe_print'))
   @if(Request::is('recipes/all'))
      <a href="{{ route('recipes.printAll', 'all') }}" class="btn btn-{{ $size }} btn-primary" title="Print All">
         <i class="{{ Config::get('buttons.print') }}"></i>
      </a>
   @else
      <a href="{{ route('recipes.printAll', Request::segment(2)) }}" class="btn btn-{{ $size }} btn-primary" title="Print All in Category">
         <i class="{{ Config::get('buttons.print') }}"></i>
      </a>
   @endif
@endif
