@if(checkPerm('comment_edit'))
   {{-- <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      type="button"
      onclick="location.href='{{ route('admin.comments.edit', $comment->id) }}'"
      title="Edit Comment">
      <i class="{{ Config::get('buttons.edit') }}"></i>
      {{ $btn_label ?? '' }}
   </button> --}}
   <a href="{{ route('admin.comments.edit', $comment->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      title="Edit Comment">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@endif

{{-- @else
   <button class="btn {{ $size ? 'btn-'.$size : '' }} btn-info" disabled="disabled">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </button> --}}