<a href="{{ url()->previous() }}"
   class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary d-print-none"
   title="Back">
   <i class="{{ Config::get('buttons.back') }}"></i>
   {{-- Back --}}
   {{ $btn_label ?? '' }}
</a>