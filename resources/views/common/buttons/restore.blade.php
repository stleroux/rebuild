<button
   class="btn btn-sm btn-outline-secondary"
   type="submit"
   formaction="{{ route($model.'s'.'.restore', $id) }}"
   formmethod="GET"
   title="Restore {{ ucfirst($model) }}">
   <i class="fas fa-trash-restore-alt"></i>
   @if($type == 'menu')
      Restore {{ ucfirst($model) }}
   @endif
</button>