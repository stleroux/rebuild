@if(checkPerm($name.'_makePrivate', $model))
   <button
      class="btn btn-sm btn-outline-secondary"
      type="submit"
      formaction="{{ route($name.'s'.'.makePrivate', $model->id) }}"
      formmethod="GET"
      title="Make Private">
      <i class="far fa-eye-slash"></i>
   </button>
@endif