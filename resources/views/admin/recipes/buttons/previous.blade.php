@if($previous)
   <a href="{{ route('admin.recipes.show', $previous) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light col-sm-5"
      title="Previous Recipe">
      <i class="{{ Config::get('buttons.previous') }}"></i>
      {{ $btn_label ?? '' }}
   </a>
@endif
