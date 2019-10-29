@if(checkPerm('post_delete', $post))
   <a href="{{-- {{ route('admin.posts.delete', $post->id) }} --}}"
      class="btn btn-{{ $size }} btn-danger text-light"
      title="Delete Image">
      <i class="{{ Config::get('buttons.trash') }}"></i>
   </a>
@endif