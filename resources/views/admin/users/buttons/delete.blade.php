@if(checkPerm('user_delete'))
   @if($user->username != 'administrator')
      <a href="{{ route('admin.users.delete', $user->id) }}"
         class="btn btn-{{ $size }} btn-danger text-light"
         title="Delete User">
         <i class="fas fa-trash-alt"></i>
      </a>
   @else
      <button class="btn btn-{{ $size }} btn-danger text-light" disabled="disabled">
         <i class="fas fa-trash-alt"></i>
      </button>
   @endif
@endif
