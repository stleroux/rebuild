<a href="{{ route('posts.unpublished') }}"
   class="btn btn-{{ $size }} btn-{{ Route::is('posts.unpublished') ? 'secondary' : 'primary' }} text-light"
   title="Unpublished Posts">
   <i class="fas fa-ban"></i>
</a>
