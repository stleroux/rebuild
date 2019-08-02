@if(checkPerm('recipe_print'))
   @if(Request::is('recipes/all'))
      <a href="{{ route('recipes.printAll', 'all') }}" class="btn btn-sm btn-primary px-0 py-1" title="Print All">
         <i class="{{ Config::get('buttons.print') }}"></i>
      </a>
   @else
      <a href="{{ route('recipes.printAll', Request::segment(2)) }}" class="btn btn-sm btn-primary px-0 py-1" title="Print All in Category">
         <i class="{{ Config::get('buttons.print') }}"></i>
      </a>
   @endif
@endif