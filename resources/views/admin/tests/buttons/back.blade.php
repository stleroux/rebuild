<a href="{{ route('tests.index') }}"
   class="btn btn-sm btn-primary"
   title="Test">
   <i class="{{ Config::get('buttons.back') }}"></i>
</a>

@if(Session::get('fromPage')==='test.index')
   <a href="{{ route('admin.test.index') }}"
      class="btn btn-sm btn-primary"
      title="Test">
      <i class="{{ Config::get('buttons.back') }}"></i>
   </a>
@elseif(Session::get('fromPage'))
   <a href="{{ route(Session::get('fromPage')) }}"
      class="btn btn-sm btn-primary"
      title="Back">
      <i class="{{ Config::get('buttons.back') }}"></i>
   </a>
@endif