@if($action === 'add')
   @if(checkPerm($name . '_add'))
      <button
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
         type="button"
         onclick="location.href='{{ route('admin.' . str_plural($name) . '.create') }}'"
         title="Add {{ ucfirst($name) }}">
         <i class="{{ Config::get('buttons.add') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'back')
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      type="button"
      onclick="location.href='{{ route('admin.' . str_plural($name) . '.index') }}'"
      title="Back">
      <i class="{{ Config::get('buttons.back') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif

@if($action === 'btn_delete')
   @if(checkPerm($name . '_delete'))
      <button
         class="btn {{ $size ? 'btn-.$size' : '' }} btn-danger text-light"
         type="submit"
         formaction="{{ route('admin.' . str_plural($name) . '.destroy', $model->id) }}"
         formmethod="POST"
         title="Delete {{ ucfirst($name) }}">
         <i class="{{ Config::get('buttons.delete') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'delete')
   @if(checkPerm($name . '_delete'))
      <button
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
         type="submit"
         formaction="{{ route('admin.' . str_plural($name) . '.delete', $model->id) }}"
         formmethod="GET"
         title="Delete {{ ucfirst($name) }}">
         <i class="{{ Config::get('buttons.trash') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'edit')
   @if(checkPerm($name . '_edit'))
      <button
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
         type="button"
         onclick="location.href='{{ route('admin.' . str_plural($name) . '.edit', $model->id) }}'"
         title="Edit {{ ucfirst($name) }}">
         <i class="{{ Config::get('buttons.edit') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'help')
   @auth
      <a href="/help#{{$bookmark}}"
         target="_blank"
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         title="Help">
         <i class="{{ Config::get('buttons.help') }}"></i>
      </a>
   @endauth
@endif

@if($action === 'reset')
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      type="reset"
      formmethod="POST"
      title="Reset Form">
      <i class="{{ Config::get('buttons.reset') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif

@if($action === 'save')
   @if(checkPerm($name . '_add'))
      <button
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
         type="submit"
         formaction="{{ route('admin.' . str_plural($name) . '.store') }}"
         formmethod="POST"
         title="Save {{ ucfirst($name) }}">
         <i class="{{ Config::get('buttons.save') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'show')
   @if(checkPerm($name . '_read'))
      <button
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
         type="button"
         onclick="location.href='{{ route('admin.' . str_plural($name) . '.show', $model->id) }}'"
         title="Show {{ ucfirst($name) }}">
         <i class="{{ Config::get('buttons.show') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'update')
   @if(checkPerm($name . '_edit'))
      <button
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
         type="submit"
         formaction="{{ route('admin.' . str_plural($name) . '.update', $model->id) }}"
         formmethod="POST"
         title="Update {{ ucfirst($name) }}">
         <i class="{{ Config::get('buttons.update') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif