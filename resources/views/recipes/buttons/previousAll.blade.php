@if($previous)
   <a href="{{ route('recipes.show', $previous) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light col-sm-4"
      title="Previous Recipe">
      <i class="{{ Config::get('buttons.previous') }}"></i>
      {{-- Previous --}}
      {{ $btn_label ?? '' }}
   </a>
@endif
