@if(checkPerm('movie_edit', $movie))
   <a href="{{ route('admin.movies.edit', $movie->id) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
      title="Edit Movie">
      <i class="{{ Config::get('buttons.edit') }}"></i>
   </a>
@endif