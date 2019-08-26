{{-- ALPHABET START --}}
@if($page == 'index')
   <div class="text-center">
      <div class="btn-group" role="group">
         <a href="{{ route('posts.index') }}"
            class="{{ Request::is('posts') ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route('posts.index', $value) }}"
               class="{{ Request::is('posts/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      </div>
   </div>
@else
   <div class="text-center">
      <div class="btn-group" role="group">
         <a href="{{ route('posts.'.$page) }}"
            class="{{ Request::is('posts/' . $page) ? "btn-secondary": "btn-primary" }} btn btn-sm">
            All
         </a>
         @foreach($letters as $value)
            <a href="{{ route('posts.' . $page, $value) }}"
               class="{{ Request::is('posts/' . $page . '/' . $value) ? "btn-secondary": "btn-primary" }} btn btn-sm">
               {{ strtoupper($value) }}
            </a>
         @endforeach
      </div>
   </div>
@endif
{{-- ALPHABET END --}}
