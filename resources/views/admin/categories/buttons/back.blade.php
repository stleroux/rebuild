<button
   class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
   type="button"
   onclick="location.href='{{ route('admin.categories.index') }}'"
   title="Back">
   <i class="{{ Config::get('buttons.back') }}"></i>
   {{ $btn_label ?? '' }}
</button>

{{-- <a href="{{ route('admin.categories.index') }}"
   class="btn btn-{{ $size }} btn-primary text-light"
   title="Back">
   <i class="{{ Config::get('buttons.back') }}"></i>
   {{ $btn_label ?? '' }}
</a>
 --}}