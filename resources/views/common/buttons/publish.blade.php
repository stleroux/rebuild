@if(checkPerm($name.'_publish', $model))
   <button
      class="btn btn-sm btn-outline-secondary"
      type="submit"
      formaction="{{ route($name.'s'.'.publish', $model->id) }}"
      formmethod="GET"
      title="Publish">
      <i class="fas fa-upload"></i>
   </button>
@endif