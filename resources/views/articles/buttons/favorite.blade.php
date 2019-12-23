@auth
   @if(!$article->isFavorited())
      <a href="{{ route('articles.favoriteAdd', $article->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Add Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-success"></i>
         {{ $btn_label ?? '' }}
      </a>
   @else
      <a href="{{ route('articles.favoriteRemove', $article->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Remove Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-danger"></i>
         {{ $btn_label ?? '' }}
      </a>
   @endif
@endauth
