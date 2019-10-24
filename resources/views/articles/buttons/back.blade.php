<a href="{{ route('articles.index') }}"
   class="btn btn-{{ $size }} btn-primary d-print-none"
   title="Back">
   <i class="{{ Config::get('buttons.back') }}"></i>
   {{ $btn_label ?? '' }}
</a>
