<div class="card mb-3">
   <div class="card-header block_header">
      Main Menu
   </div>
   <div class="list-group py-0 px-0">

      <a href="/"
         class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/') ? 'active' : '' }}">
         <i class="fas fa-home pl-2"></i>
         Home
      </a>
      
      <a href="#"
         class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('albums*') ? 'active' : '' }}">
         <i class="text-danger">
            <i class="fas fa-camera-retro pl-2"></i>
            Albums
         </i>
      </a>

      <a href="{{ route('articles.index') }}"
         class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('articles.*') ? 'active' : '' }}">
         <i class="text-danger">
            <i class="far fa-newspaper pl-2"></i>
            Articles
         </i>
      </a>

      <a href="{{ route('blog.index') }}"
         class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('blog*') ? 'active' : '' }}">
         <i class="fas fa-blog pl-2"></i>
         Blog
      </a>

      @if(checkPerm('category_index'))
         <a href="{{ route('categories.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Request::is('categories*') ? 'active' : '' }}">
            <i class="fa fa-sitemap pl-2"></i>
            Categories
         </a>
      @endif

      @if(checkPerm('comment_index'))
         <a href="{{ route('comments.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Request::is('comments*') ? 'active' : '' }}">
            <i class="fas fa-comments pl-2"></i>
            Comments
         </a>
      @endif

      <a href="#"
         class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('darts.*') ? 'active' : '' }}">
         <i class="text-danger">
            <i class="fas fa-bullseye pl-2"></i>
            Darts
         </i>
      </a>

      @if(checkPerm('invoicer_index'))
         <a href="{{ route('invoicer') }}"
            class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('invoicer.*') ? 'active' : '' }}">
            <i class="fas fa-file-invoice pl-2"></i>
            Invoicer
         </a>
      @endif

      @if(checkPerm('permission_index'))
         <a href="{{ route('permissions.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Route::is('permissions.*') ? 'active' : '' }}">
            <i class="fas fa-shield-alt pl-2"></i>
            Permissions
         </a>
      @endif

      @if(checkPerm('post_index'))
         <a href="{{ route('posts.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Request::is('posts*') ? 'active' : '' }}">
            <i class="far fa-newspaper pl-2"></i>
            Posts
         </a>
      @endif

      <a href="{{ route('recipes.index', 'all') }}"
         class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('recipes.index','recipes.myRecipes','recipes.myFavorites') ? 'active' : '' }}">
         <i class="fab fa-apple pl-2"></i>
         Recipes
      </a>

      @if(checkPerm('site_settings'))
         <a href="{{ route('settings.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Route::is('settings.*') ? 'active' : '' }}">
            <i class="fas fa-cog pl-2"></i>
            Site Settings
         </a>
      @endif

      @if(checkPerm('site_stats'))
         <a href="{{ route('stats') }}"
            class="list-group-item list-group-item-action p-1 {{ Route::is('stats*') ? 'active' : '' }}">
            <i class="fas fa-chart-pie pl-2"></i>
            Site Statistics
         </a>
      @endif

      @if(checkPerm('user_index'))
         <a href="{{ route('users.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Route::is('users.*') ? 'active' : '' }}">
            <i class="fas fa-users pl-2"></i>
            Users
         </a>
      @endif

      {{-- @if(checkPerm('projects_index')) --}}
         <a href="{{ route('projects.index') }}"
            class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('projects.*') ? 'active' : '' }}">
            <i class="fab fa-pagelines pl-2"></i>
            Projects
         </a>
      {{-- @endif --}}
   </div>
</div>
