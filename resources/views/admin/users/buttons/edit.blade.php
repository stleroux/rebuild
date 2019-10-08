@if(checkPerm('user_edit'))
   @if($user->username != 'administrator')
      @if(checkPerm('user_edit'))
         <a href="{{ route('admin.users.edit', $user->id) }}"
            class="btn btn-{{ $size }} btn-info text-light"
            title="Edit User">
            <i class="far fa-edit"></i>
         </a>
      @else
         <button class="btn btn-{{ $size }} btn-info text-light" disabled="disabled">
            <i class="far fa-edit"></i>
         </button>
      @endif
   @else
      <button class="btn btn-{{ $size }} btn-info text-light" disabled="disabled">
         <i class="far fa-edit"></i>
      </button>
   @endif
@endif
