@if(checkPerm('movie_create'))
   <a href="{{ route('admin.movies.create') }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
      title="Add Movie">
      <i class="{{ Config::get('buttons.add') }}"></i>
   </a>
@endif
