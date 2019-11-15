@if($next)
   <a href="{{ route('articles.show', $next) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light col-sm-5"
      title="Next Article">
      {{ $btn_label ?? '' }}
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
