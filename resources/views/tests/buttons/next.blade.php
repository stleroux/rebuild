@if($next)
   <a href="{{ route('tests.show', [$next]) }}"
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      title="Next Test">
      View Next
      <i class="{{ Config::get('buttons.next') }}"></i>
   </a>
@endif
