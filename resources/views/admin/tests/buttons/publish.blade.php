@if(checkPerm('test_edit', $test))
   @if(!$test->published_at)
      <a href="{{ route('admin.tests.publish', $test->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Publish {$name}">
         <i class="{{ Config::get('buttons.publish') }} text-success"></i>
      </a>
   @else
      <a href="{{ route('admin.tests.unpublish', $test->id) }}"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Unpublish {$name}">
         <i class="{{ Config::get('buttons.publish') }} text-danger"></i>
      </a>
   @endif
@endif
