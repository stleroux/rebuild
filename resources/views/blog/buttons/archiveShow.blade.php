<a href="{{ route('blog.show', $archive->slug) }}"
   class="btn btn-{{$size}} btn-primary text-light"
   title="View Blog">
   <i class="{{ Config::get('buttons.show') }}"></i>
</a>
