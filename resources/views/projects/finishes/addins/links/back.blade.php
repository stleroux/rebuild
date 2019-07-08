<a href="{{ route('finishes.index') }}"
   class="btn btn-sm btn-primary"
   title="Finishes">
   <i class="{{ Config::get('buttons.back') }}"></i>
</a>

{{-- @if(Session::get('fromPage')==='finishes.index')
   <a href="{{ route('finishes.index') }}"
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
@endif --}}