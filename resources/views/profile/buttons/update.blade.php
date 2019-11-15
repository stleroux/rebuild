<button
   class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
   type="submit"
   title="Update User">
   <i class="{{ Config::get('buttons.save') }}"></i>
   {{ $btn_label ?? '' }}
</button>
