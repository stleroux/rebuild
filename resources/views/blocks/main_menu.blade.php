<div class="card mb-2 p-0 m-0">
   <div class="card-header block_header p-2 m-0">
      Main Menu
   </div>
   <div class="list-group">

      <a href="/"
         class="list-group-item list-group-item-action p-1 {{ Request::is('/') ? 'menu_active' : '' }}">
         <i class="fas fa-home fa-fw"></i>
         Home
      </a>
      
      @if(checkPerm('albums_index'))
         <a href="#"
            class="list-group-item list-group-item-action p-1 {{ Request::is('albums*') ? 'menu_active' : '' }}">
            <i class="text-danger">
               <i class="fas fa-camera-retro fa-fw"></i>
               Albums
            </i>
         </a>
      @endif

      @if(checkPerm('article_index'))
         <a href="{{ route('articles.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Route::is('articles.*') ? 'menu_active' : '' }}">
            <i class="text-danger">
               <i class="far fa-newspaper fa-fw"></i>
               Articles
            </i>
         </a>
      @endif

      <a href="{{ route('blog.index') }}"
         class="list-group-item list-group-item-action p-1 {{ Request::is('blog*') ? 'menu_active' : '' }}">
         <i class="fas fa-blog fa-fw"></i>
         Blog
      </a>

      @if(checkPerm('category_index'))
         <a href="{{ route('categories.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Request::is('categories*') ? 'menu_active' : '' }}">
            <i class="fa fa-sitemap fa-fw"></i>
            Categories
         </a>
      @endif

      @if(checkPerm('comment_index'))
         <a href="{{ route('comments.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Request::is('comments*') ? 'menu_active' : '' }}">
            <i class="fas fa-comments fa-fw"></i>
            Comments
         </a>
      @endif

      @if(checkPerm('dart_index'))
         <a href="#"
            class="list-group-item list-group-item-action p-1 {{ Route::is('darts.*') ? 'menu_active' : '' }}">
            <i class="text-danger">
               <i class="fas fa-bullseye fa-fw"></i>
               Darts
            </i>
         </a>
      @endif

      @if(checkPerm('invoicer_index'))
         <a href="{{ route('invoicer') }}"
            class="list-group-item list-group-item-action p-1 {{ Route::is('invoicer.*') ? 'menu_active' : '' }}">
            <i class="fas fa-file-invoice fa-fw"></i>
            Invoicer
         </a>
      @endif

      @if(checkPerm('permission_index'))
         <a href="{{ route('permissions.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Route::is('permissions.*') ? 'menu_active' : '' }}">
            <i class="fas fa-shield-alt fa-fw"></i>
            Permissions
         </a>
      @endif

      @if(checkPerm('post_index'))
         <a href="{{ route('posts.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Request::is('posts*') ? 'menu_active' : '' }}">
            <i class="far fa-newspaper fa-fw"></i>
            Posts
         </a>
      @endif

      <a href="{{ route('projects.index') }}"
         class="list-group-item list-group-item-action p-1 {{ (Route::is('projects.index') || Route::is('projects.show')) ? 'menu_active' : '' }}">
         <i class="fab fa-pagelines fa-fw"></i>
         Projects
      </a>

      @if(checkPerm('projects_index'))
         <a href="{{ route('projects.list') }}"
            class="list-group-item list-group-item-action p-1 {{
            (
               Route::is('projects.list') ||
               Route::is('projects.edit') ||
               Route::is('projects.create') ||
               Route::is('finishes*') ||
               Route::is('materials*')
            ) ? 'menu_active' : '' }}">
            <i class="fas fa-list-ol fa-fw"></i>
            Projects List
         </a>
      @endif

      <a href="{{ route('recipes.index', 'all') }}"
         class="list-group-item list-group-item-action p-1 {{ Route::is('recipes.*') ? 'menu_active' : '' }}">
         <i class="fab fa-apple fa-fw"></i>
         Recipes
      </a>

      @if(checkPerm('site_settings'))
         <a href="{{ route('settings.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Route::is('settings.*') ? 'menu_active' : '' }} text-warning">
            <i class="fas fa-cog fa-fw"></i>
            Site Settings
         </a>
      @endif

      @if(checkPerm('site_stats'))
         <a href="{{ route('stats') }}"
            class="list-group-item list-group-item-action p-1 {{ Route::is('stats*') ? 'menu_active' : '' }} text-warning">
            <i class="fas fa-chart-pie fa-fw"></i>
            Site Statistics
         </a>
      @endif

      @if(checkPerm('user_index'))
         <a href="{{ route('users.index') }}"
            class="list-group-item list-group-item-action p-1 {{ Route::is('users.*') ? 'menu_active' : '' }}">
            <i class="fas fa-users fa-fw"></i>
            Users
         </a>
      @endif

   </div>
</div>
