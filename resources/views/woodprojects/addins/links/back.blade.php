<a href="{{ route('woodprojects.index') }}"
   class="btn btn-sm btn-primary"
   title="Woodproject">
   <i class="{{ Config::get('buttons.back') }}"></i>
</a>

{{-- @if(Session::get('fromPage')==='woodproject.index')
   <a href="{{ route('woodproject.index') }}"
      class="btn btn-sm btn-primary"
      title="Woodproject">
      <i class="{{ Config::get('buttons.back') }}"></i>
   </a>
@elseif(Session::get('fromPage'))
   <a href="{{ route(Session::get('fromPage')) }}"
      class="btn btn-sm btn-primary"
      title="Back">
      <i class="{{ Config::get('buttons.back') }}"></i>
   </a>
@endif --}}