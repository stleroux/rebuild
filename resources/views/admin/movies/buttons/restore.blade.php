@if(checkPerm('movie_delete', $movie))
   <a href="{{ route('admin.movies.restore', $movie->id) }}"
      class="btn btn-{{ $size }} btn-info text-light"
      title="Restore Movie">
      <i class="{{ Config::get('buttons.restore') }}"></i>
   </a>
@endif
