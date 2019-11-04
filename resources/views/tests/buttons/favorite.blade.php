@auth
   @if(!$test->isFavorited())
      <a href="{{ route('tests.favoriteAdd', $test->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
         title="Add Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-success"></i>
         {{ $btn_label ?? '' }}
      </a>
   @else
      <a href="{{ route('tests.favoriteRemove', $test->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
         title="Remove Favorite">
         <i class="{{ Config::get('buttons.favorite') }} text-danger"></i>
         {{ $btn_label ?? '' }}
      </a>
   @endif
@endauth
