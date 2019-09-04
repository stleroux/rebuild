<a href="{{ route('posts.newPosts') }}"
   class="btn btn-{{ $size }} btn-{{ Route::is('posts.newPosts') ? 'secondary' : 'primary' }} text-light"
   title="New Posts">
   <i class="{{ Config::get('buttons.new') }}"></i>
</a>