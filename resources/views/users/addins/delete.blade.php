@if($user->username != 'administrator')
   <a href="{{ route('users.delete', $user->id) }}"
      class="btn btn-sm btn-danger"
      title="Delete User">
      <i class="fas fa-trash-alt"></i>
   </a>
@else
   <button class="btn btn-sm btn-danger" disabled="disabled">
      <i class="fas fa-trash-alt"></i>
   </button>
@endif
