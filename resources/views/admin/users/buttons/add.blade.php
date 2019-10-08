@if(checkPerm('user_add'))
   <a href="{{ route('admin.users.create') }}"
      class="btn btn-{{ $size }} btn-success text-light"
      title="Add ">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif
