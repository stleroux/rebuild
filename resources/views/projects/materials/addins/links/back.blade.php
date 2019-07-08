<a href="{{ route('materials.index') }}"
   class="btn btn-sm btn-primary"
   title="Materials">
   <i class="{{ Config::get('buttons.back') }}"></i>
</a>

{{-- @if(Session::get('fromPage')==='materials.index')
   <a href="{{ route('materials.index') }}"
      class="btn btn-sm btn-primary"
      title="Materials">
      <i class="{{ Config::get('buttons.back') }}"></i>
   </a>
@elseif(Session::get('fromPage'))
   <a href="{{ route(Session::get('fromPage')) }}"
      class="btn btn-sm btn-primary"
      title="Back">
      <i class="{{ Config::get('buttons.back') }}"></i>
   </a>
@endif --}}