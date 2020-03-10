@auth
   @if(!$movie->isFavorited())
      <a href="{{ route('movies.favoriteAdd', $movie->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Add Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-success"></i>
         Add Favorite
      </a>
   @else
      <a href="{{ route('movies.favoriteRemove', $movie->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Remove Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-danger"></i>
         Remove Favorite
      </a>
   @endif
@endauth
