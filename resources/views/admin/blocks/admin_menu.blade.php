@if(checkPerm('admin_menu'))
   <div class="card mb-3 p-0 m-0">
      <div class="card-header block_header p-2 m-0">
         Admin Menu
      </div>
      <div class="list-group">

         @if(checkPerm('albums_index'))
            <a href="#"
               class="list-group-item list-group-item-action p-1 {{ Request::is('albums*') ? 'menu_active' : '' }} text-danger">
               <i class="fas fa-camera-retro fa-fw"></i>
               Albums
            </a>
         @endif

         @if(checkPerm('article_index'))
            <a href="{{ route('admin.articles.index') }}"
               class="list-group-item list-group-item-action p-1 {{ Route::is('admin.articles.*') ? 'menu_active' : '' }} text-danger">
               <i class="far fa-newspaper fa-fw"></i>
               Articles
            </a>
         @endif

         @if(checkPerm('category_browse'))
            <a href="{{ route('admin.categories.index') }}"
               class="list-group-item list-group-item-action p-1 {{ Request::is('admin/categories*') ? 'menu_active' : '' }}">
               <i class="fa fa-sitemap fa-fw"></i>
               Categories
            </a>
         @endif

         @if(checkPerm('comment_browse'))
            <a href="{{ route('admin.comments.index') }}"
               class="list-group-item list-group-item-action p-1 {{ Request::is('admin/comments*') ? 'menu_active' : '' }}">
               <i class="fas fa-comments fa-fw"></i>
               Comments
            </a>
         @endif

         @if(checkPerm('permission_browse'))
            <a href="{{ route('admin.permissions.index') }}"
               class="list-group-item list-group-item-action p-1 {{ Route::is('admin.permissions.*') ? 'menu_active' : '' }}">
               <i class="fas fa-shield-alt fa-fw"></i>
               Permissions
            </a>
         @endif

         @if(checkPerm('post_browse'))
            <a href="{{ route('admin.posts.index') }}"
               class="list-group-item list-group-item-action p-1 {{ Request::is('admin/posts*') ? 'menu_active' : '' }}">
               <i class="far fa-newspaper fa-fw"></i>
               Posts
            </a>
         @endif

         @if(checkPerm('projects_browse'))
            <a href="{{ route('admin.projects.index') }}"
               class="list-group-item list-group-item-action p-1 {{
               (
                  Route::is('admin.projects.index') ||
                  Route::is('admin.projects.show') ||
                  Route::is('admin.projects.edit') ||
                  Route::is('admin.projects.create') ||
                  Route::is('admin.projects.finishes*') ||
                  Route::is('admin.projects.materials*')
               ) ? 'menu_active' : '' }}">
               <i class="fas fa-list-ol fa-fw"></i>
               Projects
            </a>
         @endif

         @if(checkPerm('recipe_browse'))
            <a href="{{ route('admin.recipes.index') }}"
               class="list-group-item list-group-item-action p-1 {{
               (
                  Route::is('admin.recipes*')
                  // Route::is('admin.recipes.index') ||
                  // Route::is('admin.recipes.show') ||
                  // Route::is('admin.recipes.edit') ||
                  // Route::is('admin.recipes.create') ||
                  // Route::is('admin.recipes.trash') ||
                  // Route::is('admin.recipes.unpublished') ||
                  // Route::is('admin.recipes.newRecipes') ||
                  // Route::is('admin.recipes.future') ||
                  // Route::is('admin.recipes.trashed')
               ) ? 'menu_active' : '' }}">
               <i class="fab fa-apple fa-fw"></i>
               Recipes
            </a>
         @endif

         @if(checkPerm('settings'))
            <a href="{{ route('admin.settings.index') }}"
               class="list-group-item list-group-item-action p-1 {{ Route::is('admin.settings.*') ? 'menu_active' : '' }}">
               <i class="fas fa-cog fa-fw"></i>
               Site Settings
            </a>
         @endif

         @if(checkPerm('site_stats'))
            <a href="{{ route('admin.stats') }}"
               class="list-group-item list-group-item-action p-1 {{ Route::is('admin.stats*') ? 'menu_active' : '' }}">
               <i class="fas fa-chart-pie fa-fw"></i>
               Site Statistics
            </a>
         @endif

         @if(checkPerm('user_browse'))
            <a href="{{ route('admin.users.index') }}"
               class="list-group-item list-group-item-action p-1 {{ Route::is('admin.users.*') ? 'menu_active' : '' }}">
               <i class="fas fa-users fa-fw"></i>
               Users
            </a>
         @endif

      </div>
   </div>
@endif
