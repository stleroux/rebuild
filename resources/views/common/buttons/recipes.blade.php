{{-- <button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.index', 'all') }}"
   formmethod="GET"
   title="{{ ucfirst($model) }}s">
   <i class="fab fa-apple"></i>
   @if($type == 'menu')
      Recipes
   @endif
</button> --}}

<a href="{{ route(str_plural($model).'.index', 'all') }}"
   class="btn btn-sm btn-outline-secondary"
   title="{{ ucfirst($model) }}s">
   <i class="fab fa-apple"></i>
   @if($type == 'menu')
      Recipes
   @endif
</a>