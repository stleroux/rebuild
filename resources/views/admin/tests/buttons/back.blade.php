<a href="{{ (url()->full() == Session::get('fromPage')) ? route('admin.tests.index') : Session::get('fromPage') }}"
   class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary d-print-none"
   title="Back">
   <i class="{{ Config::get('buttons.back') }}"></i>
   {{ $btn_label ?? '' }}
</a>
