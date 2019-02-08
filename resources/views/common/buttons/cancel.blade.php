@php
   $page = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();
   // dd($page);
@endphp

<a href="{{ route($page) }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
   <i class="fas fa-angle-double-left"></i>
   Cancel
</a>