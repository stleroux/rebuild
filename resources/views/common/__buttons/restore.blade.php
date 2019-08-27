@if(checkPerm($name.'_restore', $model))
   <button
      class="btn btn-sm btn-outline-secondary"
      type="submit"
      formaction="{{ route($name.'s'.'.restore', $model->id) }}"
      formmethod="GET"
      title="Restore {{ ucfirst($name) }}">
      <i class="fas fa-trash-restore-alt"></i>
   </button>
@endif