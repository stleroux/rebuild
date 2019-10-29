@auth
   <a href="{{ route('articles.myFavorites') }}"
      class="btn btn-{{ $size }} btn-primary d-print-none"
      title="My Favorites">
      <i class="{{ Config::get('buttons.favorite') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endauth

   {{-- <i class="fas fa-heart fa-fw"></i> --}}