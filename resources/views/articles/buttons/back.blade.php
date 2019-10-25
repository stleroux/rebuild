<a href="{{ (url()->full() == Session::get('fromPage')) ? route('articles.index') : Session::get('fromPage') }}"
   class="btn btn-{{ $size }} btn-primary d-print-none"
   title="Back">
   <i class="{{ Config::get('buttons.back') }}"></i>
   {{ $btn_label ?? '' }}
</a>
