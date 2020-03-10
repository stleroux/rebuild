@auth
   @if(!$movie->isFavorited())
      <a href="{{ route('movies.favoriteAdd', $movie->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Add Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-success"></i>
         {{ $btn_label ?? '' }}
      </a>
   @else
      <a href="{{ route('movies.favoriteRemove', $movie->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Remove Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-danger"></i>
         {{ $btn_label ?? '' }}
      </a>
   @endif
@endauth
