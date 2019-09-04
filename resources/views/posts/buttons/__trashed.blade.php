<a href="{{ route('posts.trashed') }}"
   class="btn btn-{{ $size }} btn-{{ Route::is('posts.trashed') ? 'secondary' : 'primary' }} text-light"
   title="Trashed Posts">
   <i class="far fa-trash-alt"></i>
</a>