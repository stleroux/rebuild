@if(checkPerm('user_edit'))
   <a href="{{ route('users.edit', $user->id) }}"
      class="btn btn-sm btn-primary"
      title="Edit User">
      <i class="far fa-edit"></i>
   </a>
@else
   <button class="btn btn-sm btn-primary" disabled="disabled">
      <i class="far fa-edit"></i>
   </button>
@endif