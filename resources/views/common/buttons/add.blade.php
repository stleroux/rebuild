{{-- <button
   class="btn btn-sm btn-outline-success"
   type="submit"
   formaction="{{ route($model.'s'.'.create') }}"
   formmethod=""
   title="Add {{ ucfirst($model) }}">
   <i class="fa fa-plus-square"></i>
   @if($type == 'menu')
      Add {{ ucfirst($model) }}
   @endif
</button>
 --}}
<a href="{{ route(str_plural($model).'.create') }}"
   class="btn btn-sm btn-outline-success"
   title="Add {{ ucfirst($model) }}">
   <i class="fa fa-plus-square"></i>
   @if($type == 'menu')
      Add {{ ucfirst($model) }}
   @endif
</a>
