@auth
   <a href="{{ route('tests.myFavorites') }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary d-print-none"
      title="My Favorites">
      <i class="{{ Config::get('buttons.favorite') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endauth
