{{-- <button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.unpublish', $id) }}"
   formmethod="GET"
   title="Unpublish">
   <i class="fas fa-download"></i>
   @if($type == 'menu')
      Unpublish
   @endif
</button> --}}

<a href="{{ route(str_plural($model).'.unpublish', $id) }}"
   class="btn btn-sm btn-outline-secondary"
   title="Unpublish {{ ucfirst($model) }}">
   <i class="fas fa-download"></i>
   @if($type == 'menu')
      Unpublish {{ ucfirst($model) }}
   @endif
</a>