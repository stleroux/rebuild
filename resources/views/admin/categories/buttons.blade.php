@if($action === 'add')
   @if(checkPerm('category_add'))
      <button
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-success text-light"
         type="button"
         onclick="location.href='{{ route('admin.categories.create') }}'"
         title="Add Category">
         <i class="{{ Config::get('buttons.add') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'back')
   <button
      class="btn {{ $size ? 'btn-'.$size : '' }} btn-primary text-light"
      type="button"
      onclick="location.href='{{ route('admin.categories.index') }}'"
      title="Back">
      <i class="{{ Config::get('buttons.back') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif

@if($action === 'btn_delete')
   @if(checkPerm('category_delete'))
      <button
         class="btn {{ $size ? 'btn-.$size' : '' }} btn-danger text-light"
         type="submit"
         formaction="{{ route('admin.categories.destroy', $category->id) }}"
         formmethod="POST"
         title="Delete Category">
         <i class="{{ Config::get('buttons.delete') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'delete')
   @if(checkPerm('category_delete'))
      <button
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-danger text-light"
         type="submit"
         formaction="{{ route('admin.categories.delete', $category->id) }}"
         formmethod="GET"
         title="Delete Category">
         <i class="{{ Config::get('buttons.trash') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'edit')
   @if(checkPerm('category_edit'))
      <button
         class="btn {{ $size ? 'btn-'.$size : '' }} btn-info text-light"
         type="button"
         onclick="location.href='{{ route('admin.categories.edit', $category->id) }}'"
         title="Edit Category">
         <i class="{{ Config::get('buttons.edit') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'help')
   @auth
      <a href="/help#{{$bookmark}}"
         target="_blank"
         class="btn btn-{{ $size }} btn-primary text-light"
         title="Help">
         <i class="{{ Config::get('buttons.help') }}"></i>
      </a>
   @endauth
@endif

@if($action === 'reset')
   <button
      class="btn btn-{{ $size }} btn-primary text-light"
      type="reset"
      formmethod="POST"
      title="Reset Form">
      <i class="{{ Config::get('buttons.reset') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif

@if($action === 'save')
   @if(checkPerm('category_add'))
      <button
         class="btn btn-{{ $size }} btn-success text-light"
         type="submit"
         formaction="{{ route('admin.categories.store') }}"
         formmethod="POST"
         title="Save Category">
         <i class="{{ Config::get('buttons.save') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'show')
   @if(checkPerm('category_read'))
      <button
         class="btn btn-{{ $size }} btn-primary text-light"
         type="button"
         onclick="location.href='{{ route('admin.categories.show', $category->id) }}'"
         title="Show Category">
         <i class="{{ Config::get('buttons.show') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif

@if($action === 'update')
   @if(checkPerm('category_edit'))
      <button
         class="btn btn-{{ $size }} btn-info text-light"
         type="submit"
         formaction="{{ route('admin.categories.update', $category->id) }}"
         formmethod="POST"
         title="Update Category">
         <i class="{{ Config::get('buttons.update') }}"></i>
         {{ $btn_label ?? '' }}
      </button>
   @endif
@endif