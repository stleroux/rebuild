{{-- Posts --}}
{{-- @if(checkPerm('posts.admin')) --}}
   <li class="dropdown-submenu">
      <a href="#" class="dropdown-toggle dropdown-item" data-toggle="dropdown">Posts</a>
      <ul class="dropdown-menu">
         <li>
            <a href="{{ route('posts.index') }}" class="dropdown-item">Published Posts</a>
         </li>
         <li>
            <a href="{{ route('posts.unpublished') }}" class="dropdown-item">Unpublished Posts</a>
         </li>
         <li>
            <a href="{{ route('posts.newPosts') }}" class="dropdown-item">New Posts</a>
         </li>
         <li>
            <a href="{{ route('posts.trashed') }}" class="dropdown-item">Trashed Posts</a>
         </li>
         <li class="dropdown-divider"></li>
         <li>
            <a href="{{ route('posts.create') }}" class="dropdown-item">Add New</a>
         </li>
      </ul>
   </li>
{{-- @endif --}}