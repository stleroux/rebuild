@if(checkPerm($name.'_makePublic', $model))
   <button
      class="btn btn-sm btn-outline-secondary"
      type="submit"
      formaction="{{ route($name.'s'.'.makePublic', $model->id) }}"
      formmethod="GET"
      title="Make Public">
      <i class="far fa-eye"></i>
   </button>
@endif