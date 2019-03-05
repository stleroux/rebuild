<div class="card mb-2">
   <div class="card-header block_header">
      MAIN MENU
   </div>
   <div class="list-group py-0 px-0">
      <a href="/"
         class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('/') ? 'active' : '' }}">
         <i class="fas fa-home pl-2"></i>
         Home
      </a>
      
      @if(\Module::enabled('Posts'))
         <a href="{{ route('blog.index') }}"
            class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('blog*') ? 'active' : '' }}">
            <i class="fas fa-blog pl-2"></i>
            Blog
         </a>
      @endif

      @if(\Module::enabled('Recipes'))
         {{-- @if(!Auth::check()) --}}
            <a href="{{ route('recipes.index', 'all') }}"
               class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('recipes.index','recipes.myRecipes','recipes.myFavorites') ? 'active' : '' }}">
                  <i class="fab fa-apple pl-2"></i>
                  Recipes
            </a>
         {{-- @else --}}
            {{-- <a class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('recipes*') ? 'active' : '' }}"
               data-remote="true" href="#recipes" id="categoria_4" data-toggle="collapse" data-parent="#sub_recipes">
               <i class="fab fa-apple pl-2"></i>
               Recipes
               <span class="menu-ico-collapse float-right pr-2">
                  <i class="fa fa-chevron-down"></i>
               </span>
            </a>
            <div class="collapse list-group-submenu" id="recipes">
                  <a href="{{ route('recipes.index') }}"
                     class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('recipes.index') ? 'active' : '' }}"
                     data-parent="#sub_recipes">
                     <i class="fab fa-apple"></i>
                     All Recipes
                  </a>
                  <a href="{{ route('recipes.myRecipes') }}"
                     class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('recipes.myRecipes') ? 'active' : '' }}"
                     data-parent="#sub_recipes">
                     <i class="fas fa-dot-circle"></i>
                     My Recipes
                  </a>
                  <a href="{{ route('recipes.myFavorites') }}"
                     class="list-group-item list-group-item-action pl-4 py-1 {{ Route::is('recipes.myFavorites') ? 'active' : '' }}"
                     data-parent="#sub_recipes">
                     <i class="fab fa-gratipay"></i>
                     My Favorites
                  </a> --}}
                  {{-- <a href="{{ route('posts.trashed') }}"
                     class="list-group-item list-group-item-action pl-4 py-1 {{ Request::is('posts/trashed') ? 'active' : '' }}"
                     data-parent="#sub_recipes">
                     <i class="far fa-trash-alt"></i>
                     Trashed Posts
                     <span class="badge badge-secondary border float-right">{{ Modules\Posts\Entities\Post::trashedCount()->count() }}</span>
                  </a>
                  <a href="{{ route('posts.unpublished') }}"
                     class="list-group-item list-group-item-action pl-4 py-1 {{ Request::is('posts/unpublished') ? 'active' : '' }}"
                     data-parent="#sub_recipes">
                     <i class="fas fa-download"></i>
                     Unpublished Posts
                     <span class="badge badge-secondary border float-right">{{ Modules\Posts\Entities\Post::unpublished()->count() }}</span>
                  </a> --}}
               {{-- @endif --}}
            {{-- </div> --}}
         {{-- @endif --}}
      @endif




      <a href="#"
         class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('albums*') ? 'active' : '' }}">
         <i class="text-danger">
            <i class="fas fa-camera-retro pl-2"></i>
            Albums
         </i>
      </a>

      <a href="#"
         class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('projects.*') ? 'active' : '' }}">
         <i class="text-danger">
            <i class="fab fa-pagelines pl-2"></i>
            Woodshop Projects
         </i>
      </a>

      @if(\Module::enabled('Articles'))
         @if(checkPerm('article_index'))
            <a href="{{ route('articles') }}"
               class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('articles.*') ? 'active' : '' }}">
               <i class="text-danger">
                  <i class="far fa-newspaper pl-2"></i>
                  Articles
               </i>
            </a>
         @endif
      @endif
      
      @if(\Module::enabled('Invoicer'))
         @if(checkPerm('invoicer_index'))
            <a href="{{ route('invoicer') }}"
               {{-- target="_blank" --}}
               class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('invoicer.*') ? 'active' : '' }}">
               <i class="fas fa-file-invoice pl-2"></i>
               Invoicer
            </a>
         @endif
      @endif
      
      <a href="#"
         class="list-group-item list-group-item-action py-1 px-1 {{ Route::is('darts.*') ? 'active' : '' }}">
         <i class="text-danger">
            <i class="fas fa-bullseye pl-2"></i>
            Darts
         </i>
      </a>

   </div>
</div>