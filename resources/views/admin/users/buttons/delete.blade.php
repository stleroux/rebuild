@if(checkPerm('user_delete'))
   @if($user->username != 'administrator')
      <a href="{{ route('admin.users.delete', $user->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
         title="Delete User">
         <i class="{{ Config::get('buttons.trash') }}"></i>
         {{ $btn_label ?? '' }}
      </a>
   @else
      <button class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light" disabled="disabled">
         <i class="{{ Config::get('buttons.trash') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif
