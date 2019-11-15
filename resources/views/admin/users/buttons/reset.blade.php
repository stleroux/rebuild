<button
   class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary"
   type="reset"
   formmethod="POST"
   title="Reset Form">
   <i class="{{ Config::get('buttons.reset') }}"></i>
   {{ $btn_label ?? '' }}
</button>