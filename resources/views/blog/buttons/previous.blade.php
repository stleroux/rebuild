@if($previous)
   <a href="{{ route('blog.show', $previous) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light col-sm-5"
      title="Previous Blog">
      <i class="{{ Config::get('buttons.previous') }}"></i>
      {{-- Previous --}}
      {{ $btn_label ?? '' }}
   </a>
@endif
