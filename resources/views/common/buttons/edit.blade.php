<button
   class="btn btn-sm btn-outline-primary"
   type="submit"
   formaction="{{ route($model.'s'.'.edit', $id) }}"
   formmethod="GET"
   title="Edit {{ ucfirst($model) }}">
   <i class="far fa-edit"></i>
   @if($type == 'menu')
      Edit {{ ucfirst($model) }}
   @endif
</button>