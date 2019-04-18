<nav class="bg-dark">

   <ul class="backend_menu">
      
      <li>
         <a href="{{ Route('dashboard') }}"><i class="fa fa-cog pr-1"></i>Dashboard</a>
      </li>

      <li>
         <a href="{{ Route('categories.index') }}"><i class="fa fa-sitemap pr-1"></i>Categories</a>
         <ul>
            <li><a href="{{ Route('categories.create') }}"><i class="fa fa-plus-square pr-1"></i>Add</a></li>
         </ul>
      </li>

      <li><a href="{{ Route('comments.index') }}"><i class="fas fa-comments pr-1"></i>Comments</a></li>

      {{-- <li>
         <a href="{{ Route('components.index') }}"><i class="fas fa-boxes pr-1"></i>Components</a>
         <ul>
            <li><a href="{{ Route('components.create') }}"><i class="fa fa-plus-square pr-1"></i>Add</a></li>
         </ul>
      </li> --}}

      <li><a href="{{ Route('modules.index') }}"><i class="fa fa-cubes pr-1"></i>Modules</a>
         <ul>
            <li><a href="{{ Route('modules.create') }}"><i class="fa fa-plus-square pr-1"></i>Add</a></li>
         </ul>
      </li>

      <li><a href="{{ Route('permissions.index') }}"><i class="fas fa-shield-alt pr-1"></i>Permissions</a>
         <ul>
            <li><a href="{{ Route('permissions.create') }}"><i class="fa fa-plus-square pr-1"></i>Add</a></li>
         </ul>
      </li>

      <li><a href="{{ Route('posts.index') }}"><i class="far fa-newspaper pr-1"></i>Posts</a>
         <ul>
            <li><a href="{{ Route('posts.index') }}"><i class="fas fa-upload pr-1"></i>Published</a></li>
            <li><a href="{{ Route('posts.newPosts') }}"><i class="fas fa-dot-circle pr-1"></i>New</a></li>
            <li><a href="{{ Route('posts.trashed') }}"><i class="far fa-trash-alt pr-1"></i>Trashed</a></li>
            <li><a href="{{ Route('posts.unpublished') }}"><i class="fas fa-download pr-1"></i>Unpublished</a></li>
            <li><a href="{{ Route('posts.create') }}"><i class="fa fa-plus-square pr-1"></i>Add</a></li>
         </ul>
      </li>

      <li><a href="{{ Route('recipes.published') }}"><i class="fab fa-apple pr-1"></i>Recipes</a>
         <ul>
            <li><a href="{{ Route('recipes.published') }}"><i class="fab fa-apple pr-1"></i>Published</a></li>
            <li><a href="{{ Route('recipes.myRecipes') }}"><i class="fas fa-dot-circle pr-1"></i>My Recipes</a></li>
            <li><a href="{{ Route('recipes.myPrivateRecipes') }}"><i class="far fa-eye-slash pr-1"></i>My Private Recipes</a></li>
            <li><a href="{{ Route('recipes.newRecipes') }}"><i class="fas fa-clipboard-list pr-1"></i>New</a></li>
            <li><a href="{{ Route('recipes.future') }}"><i class="far fa-calendar-alt pr-1"></i>Future</a></li>
            <li><a href="{{ Route('recipes.trashed') }}"><i class="far fa-trash-alt pr-1"></i>Trashed</a></li>
            <li><a href="{{ Route('recipes.unpublished') }}"><i class="fas fa-download pr-1"></i>Unpublished</a></li>
            <li><a href="{{ Route('recipes.create') }}"><i class="fa fa-plus-square pr-1"></i>Add</a></li>
         </ul>
      </li>

      <li><a href="{{ Route('settings.index') }}"><i class="fas fa-cog pr-1"></i>Site Settings</a></li>

      <li><a href="{{ Route('stats') }}"><i class="fas fa-chart-pie pr-1"></i>Statistics</a></li>

      <li><a href="{{ route('users.index') }}"><i class="fas fa-users pr-1"></i>Users</a>
         <ul>
            <li><a href="{{ route('users.create') }}"><i class="fa fa-plus-square pr-1"></i>Add</a></li>
         </ul>
      </li>    

      {{-- <li><a href="#">Resume</a>
      <ul>
      <li><a href="#">item a lonng submenu</a></li>
      <li><a href="#">item</a>
      <ul>
      <li><a href="#">Ray</a></li>
      <li><a href="#">Veronica</a></li>
      <li><a href="#">Bushy</a></li>
      <li><a href="#">Havoc</a>
      <ul>
      <li><a href="#">Ray 11</a></li>
      <li><a href="#">Veronica 11</a></li>
      <li><a href="#">Bushy 11</a></li>
      <li><a href="#">Havoc 11</a></li>
      </ul>
      </li>
      </ul>
      </li>
      <li><a href="#">item</a></li>
      <li><a href="#">item</a></li>
      </ul>
      </li> --}}

  </ul>

</nav>