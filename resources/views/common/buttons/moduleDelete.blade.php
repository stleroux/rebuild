<a href="{{ route(str_plural($model).'.deleteModule', $module) }}"
   class="btn btn-sm btn-outline-danger"   
   title="Delete {{ ucfirst($model) }}">
   <i class="far fa-trash-alt"></i>
   @if($type == 'menu')
      Delete {{ ucfirst($model) }}
   @endif
</a>