{{-- <a href="{{ route($model.'s'.'.destroy', $id) }}" class="btn btn-sm btn-outline-danger px-1 py-0">
   <i class="far fa-trash-alt"></i>
   Delete
</a> --}}

{{-- {{ $id }}
<br />
{{ $model.'s.trashDestroy', $id }} --}}

{{-- {!! Form::open(['method'=>'DELETE', 'route'=>[$model.'s.trashDestroy', $id], 'class'=>'form-inline']) !!} --}}
   <button
      data-toggle="tooltip"
      data-placement="top"
      title="Delete"
      type="submit"
      class="btn btn-sm btn-outline-danger px-1 py-0"
      onclick="return confirm('Are you sure you want to delete this item?');">
      <i class="far fa-trash-alt"></i>
      Delete
   </button>
{{-- {!! Form::close() !!} --}}