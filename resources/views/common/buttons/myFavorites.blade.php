{{-- <button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.myFavorites') }}"
   formmethod="GET"
   title="My Favorite {{ ucfirst($model) }}s">
   <i class="fas fa-dot-circle"></i>
   @if($type == 'menu')
      My Favorites {{ ucfirst($model) }}
   @endif
</button> --}}

<a href="{{ route(str_plural($model).'.myFavorites') }}"
   class="btn btn-sm btn-outline-secondary"
   title="My Favorites">
   <i class="fas fa-heart"></i>
   @if($type == 'menu')
      My Favorites
   @endif
</a>