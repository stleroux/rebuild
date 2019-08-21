<a href="{{ route('posts.index') }}"
   class="btn btn-{{ $size }} btn-{{ Route::is('posts.index') ? 'secondary' : 'primary' }} text-light"
   title="Published Posts">
   <i class="fas fa-upload"></i>
</a>