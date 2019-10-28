@if($next)
   <a href="{{ route('articles.show', [$next]) }}"
      class="btn btn-{{$size}} btn-primary text-light"
      title="Next Article">
      View Next
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
