@if($next)
   <a href="{{ route('admin.recipes.show', $next) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }}btn-primary text-light col-sm-5"
      title="Next Recipe">
      {{ $btn_label ?? '' }}
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
