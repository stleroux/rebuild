@if(checkPerm('movie_edit', $movie))
   @if(!$movie->published_at)
      <a href="{{ route('admin.movies.publish', $movie->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Publish Movie">
         <i class="{{ Config::get('buttons.publish') }} text-success"></i>
      </a>
   @else
      <a href="{{ route('admin.movies.unpublish', $movie->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Unpublish Movie">
         <i class="{{ Config::get('buttons.publish') }} text-danger"></i>
      </a>
   @endif
@endif
