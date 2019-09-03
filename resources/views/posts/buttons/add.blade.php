@if(checkPerm('post_add'))
   <a href="{{ route('posts.create') }}"
      class="btn btn-{{ $size }} btn-success text-light"
      title="Add Post">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif
