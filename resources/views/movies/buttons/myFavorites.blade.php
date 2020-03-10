@auth
   <a href="{{ route('movies.myFavorites') }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light d-print-none"
      title="My Favorites">
      <i class="{{ Config::get('buttons.favorite') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endauth
