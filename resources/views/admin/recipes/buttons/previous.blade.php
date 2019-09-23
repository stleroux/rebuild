@if($previous)
   <a href="{{ route('admin.recipes.show', $previous) }}"
      class="btn btn-{{$size}} btn-primary text-light col-sm-5"
      title="Previous Recipe">
      <i class="{{ Config::get('buttons.previous') }}"></i>
      View Previous
   </a>
@endif
