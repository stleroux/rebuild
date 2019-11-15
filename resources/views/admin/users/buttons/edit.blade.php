@if(checkPerm('user_edit'))
   @if($user->username != 'administrator')
      @if(checkPerm('user_edit'))
         <a href="{{ route('admin.users.edit', $user->id) }}"
            class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
            title="Edit User">
            <i class="{{ Config::get('buttons.edit') }}"></i>
            {{ $btn_label ?? '' }}
         </a>
      @else
         <button class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light" disabled="disabled">
            <i class="{{ Config::get('buttons.edit') }}"></i>
            {{ $btn_label ?? '' }}
         </button>
      @endif
   @else
      <button class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light" disabled="disabled">
         <i class="{{ Config::get('buttons.edit') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif
