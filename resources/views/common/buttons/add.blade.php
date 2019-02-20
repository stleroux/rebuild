<button
   class="btn btn-sm btn-outline-success"
   type="submit"
   formaction="{{ route($model.'s'.'.create') }}"
   formmethod="GET"
   title="Add {{ ucfirst($model) }}">
   <i class="fa fa-plus-square"></i>
   @if($type == 'menu')
      Add {{ ucfirst($model) }}
   @endif
</button>