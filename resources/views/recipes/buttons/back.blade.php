@if(Session::get('fromPage'))
   <a href="{{ Session::get('fromPage') }}"
      class="btn btn-{{ $size }} btn-primary d-print-none"
      title="Back">
      <i class="{{ Config::get('buttons.back') }}"></i>
      Back
   </a>
@else
   <a href="\"
      class="btn btn-{{ $size }} btn-primary d-print-none"
      title="Back">
      <i class="{{ Config::get('buttons.back') }}"></i>
      Back
   </a>
@endif
