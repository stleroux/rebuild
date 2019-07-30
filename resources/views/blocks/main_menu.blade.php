<div class="card mb-3 p-0 m-0">
   <div class="card-header block_header p-2 m-0">
      Main Menu
   </div>
   <div class="list-group">

      <a href="/"
         class="list-group-item list-group-item-action p-2 {{ Request::is('/') ? 'active' : '' }}">
         <i class="fas fa-home fa-fw"></i>
         Home
      </a>
      
      <a href="#"
         class="list-group-item list-group-item-action p-2 {{ Request::is('albums*') ? 'active' : '' }}">
         <i class="text-danger">
            <i class="fas fa-camera-retro fa-fw"></i>
            Albums
         </i>
      </a>

      <a href="{{ route('articles.index') }}"
         class="list-group-item list-group-item-action p-2 {{ Route::is('articles.*') ? 'active' : '' }}">
         <i class="text-danger">
            <i class="far fa-newspaper fa-fw"></i>
            Articles
         </i>
      </a>

      <a href="{{ route('blog.index') }}"
         class="list-group-item list-group-item-action p-2 {{ Request::is('blog*') ? 'active' : '' }}">
         <i class="fas fa-blog fa-fw"></i>
         Blog
      </a>

      @if(checkPerm('category_index'))
         <a href="{{ route('categories.index') }}"
            class="list-group-item list-group-item-action p-2 {{ Request::is('categories*') ? 'active' : '' }}">
            <i class="fa fa-sitemap fa-fw"></i>
            Categories
         </a>
      @endif

      @if(checkPerm('comment_index'))
         <a href="{{ route('comments.index') }}"
            class="list-group-item list-group-item-action p-2 {{ Request::is('comments*') ? 'active' : '' }}">
            <i class="fas fa-comments fa-fw"></i>
            Comments
         </a>
      @endif

      <a href="#"
         class="list-group-item list-group-item-action p-2 {{ Route::is('darts.*') ? 'active' : '' }}">
         <i class="text-danger">
            <i class="fas fa-bullseye fa-fw"></i>
            Darts
         </i>
      </a>

      @if(checkPerm('invoicer_index'))
         <a href="{{ route('invoicer') }}"
            class="list-group-item list-group-item-action p-2 {{ Route::is('invoicer.*') ? 'active' : '' }}">
            <i class="fas fa-file-invoice fa-fw"></i>
            Invoicer
         </a>
      @endif

      @if(checkPerm('permission_index'))
         <a href="{{ route('permissions.index') }}"
            class="list-group-item list-group-item-action p-2 {{ Route::is('permissions.*') ? 'active' : '' }}">
            <i class="fas fa-shield-alt fa-fw"></i>
            Permissions
         </a>
      @endif

      @if(checkPerm('post_index'))
         <a href="{{ route('posts.index') }}"
            class="list-group-item list-group-item-action p-2 {{ Request::is('posts*') ? 'active' : '' }}">
            <i class="far fa-newspaper fa-fw"></i>
            Posts
         </a>
      @endif

      <a href="{{ route('recipes.index', 'all') }}"
         class="list-group-item list-group-item-action p-2 {{ Route::is('recipes.index','recipes.myRecipes','recipes.myFavorites') ? 'active' : '' }}">
         <i class="fab fa-apple fa-fw"></i>
         Recipes
      </a>

      {{-- @if(checkPerm('site_settings')) --}}
         <a href="{{ route('settings.index') }}"
            class="list-group-item list-group-item-action p-2 {{ Route::is('settings.*') ? 'active' : '' }} text-warning">
            <i class="fas fa-cog fa-fw"></i>
            Site Settings
         </a>
      {{-- @endif --}}

      {{-- @if(checkPerm('site_stats')) --}}
         <a href="{{ route('stats') }}"
            class="list-group-item list-group-item-action p-2 {{ Route::is('stats*') ? 'active' : '' }} text-warning">
            <i class="fas fa-chart-pie fa-fw"></i>
            Site Statistics
         </a>
      {{-- @endif --}}

      @if(checkPerm('user_index'))
         <a href="{{ route('users.index') }}"
            class="list-group-item list-group-item-action p-2 {{ Route::is('users.*') ? 'active' : '' }}">
            <i class="fas fa-users fa-fw"></i>
            Users
         </a>
      @endif

      <a href="{{ route('projects.index') }}"
         class="list-group-item list-group-item-action p-2 {{ (Route::is('projects.index') || Route::is('projects.show')) ? 'active' : '' }}">
         <i class="fab fa-pagelines fa-fw"></i>
         Projects
      </a>

      @if(checkPerm('projects_index'))
         <a href="{{ route('projects.list') }}"
            class="list-group-item list-group-item-action p-2 {{ Route::is('projects.list') ? 'active' : '' }}">
            <i class="fas fa-list-ol fa-fw"></i>
            Projects List
         </a>
      @endif
   </div>
</div>
