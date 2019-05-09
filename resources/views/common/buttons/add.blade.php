<a href="{{ route(str_plural($model).'.create') }}"
   class="btn btn-sm btn-outline-success"
   title="Add {{ ucfirst($model) }}">
   <i class="{{ Config::get('buttons.add') }}"></i>
</a>
