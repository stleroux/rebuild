@if($next)
   <a href="{{ route('recipes.show', $next) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light col-sm-4"
      title="Next Recipe">
      {{-- Next --}}
      {{ $btn_label ?? '' }}
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
