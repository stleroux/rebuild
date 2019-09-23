@if(checkPerm('permission_add'))
   <a href="{{ route('admin.permissions.create') }}"
      class="btn btn-{{ $size }} btn-success text-light"
      title="Add Permission">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif
