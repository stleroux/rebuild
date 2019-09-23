{{-- ALPHABET START --}}
@if($page == 'index')
   <div class="text-center">
      <div class="btn-group" role="group">
         <a href="{{ route('admin.posts.index') }}"
            class="{{ Request::is('admin.posts') ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route('admin.posts.index', $value) }}"
               class="{{ Request::is('admin/posts/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      </div>
   </div>
@else
   <div class="text-center">
      <div class="btn-group" role="group">
         <a href="{{ route('admin.posts.'.$page) }}"
            class="{{ Request::is('admin/posts/' . $page) ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route('admin.posts.' . $page, $value) }}"
               class="{{ Request::is('admin/posts/' . $page . '/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      </div>
   </div>
@endif
{{-- ALPHABET END --}}
