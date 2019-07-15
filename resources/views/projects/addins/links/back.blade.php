{{-- <a href="{{ route('projects.index') }}"
   class="btn btn-sm btn-primary"
   title="Project">
   <i class="{{ Config::get('buttons.back') }}"></i>
</a> --}}

{{-- @php
   dd(Session::get('fromPage'));
@endphp --}}

{{-- @if(Session::get('fromPage')==='projects.index')
   <a href="{{ route('projects.index') }}"
      class="btn btn-sm btn-primary"
      title="Projects">
      <i class="{{ Config::get('buttons.back') }}"></i>
   </a>
@elseif(Session::get('fromPage'))
   <a href="{{ route(Session::get('fromPage')) }}"
      class="btn btn-sm btn-primary"
      title="Back">
      <i class="{{ Config::get('buttons.back') }}"></i>
   </a>
@endif
 --}}
{{-- @if(Session::get('fromPage')==='projects.index') --}}
   <a href="{{ Session::get('fromPage') }}"
      class="btn btn-sm btn-primary"
      title="Back">
      <i class="{{ Config::get('buttons.back') }}"></i>
   </a>
{{-- @endif --}}