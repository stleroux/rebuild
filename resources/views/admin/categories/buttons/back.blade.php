<a href="{{ route('admin.categories.index') }}"
   class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
   title="Back">
   <i class="{{ Config::get('buttons.back') }}"></i>
   {{ $btn_label ?? '' }}
</a>
