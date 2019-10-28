@if(checkPerm('permission_delete'))
   <button
      class="btn {{ $size ? 'btn-.$size' : '' }} btn-danger text-light"
      type="submit"
      {{-- formaction="{{ route('admin.categories.destroy', $category->id) }}" --}}
      {{-- formmethod="POST" --}}
      title="Delete Permission">
      <i class="{{ Config::get('buttons.delete') }}"></i>
      {{ $btn_label ?? '' }}
   </button>
@endif
