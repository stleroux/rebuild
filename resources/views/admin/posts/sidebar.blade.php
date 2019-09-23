@if(checkPerm('post_edit') || checkPerm('post_delete'))
   <div class="card mb-2">
      <div class="card-header block_header p-2">
         <i class="far fa-newspaper"></i>
         Posts
      </div>
      
      <div class="list-group pt-0 pb-0">
         @if(checkPerm('post_edit') || checkPerm('post_delete'))
            <a href="{{ route('admin.posts.index') }}"
               class="list-group-item list-group-item-action p-1 {{ Route::is('admin.posts.index', 'admin.posts.index.*') ? 'active' : '' }}"
               data-parent="#sub_posts">
               <i class="{{ Config::get('buttons.published') }}"></i>
               Published Posts
               <span class="badge badge-secondary border float-right">{{ App\Models\Posts\Post::published()->count() }}</span>
            </a>
         @endif

         @if(checkPerm('post_edit'))
            <a href="{{ route('admin.posts.unpublished') }}"
               class="list-group-item list-group-item-action p-1 {{ Route::is('admin.posts.unpublished', 'admin.posts.unpublished.*') ? 'active' : '' }}"
               data-parent="#sub_posts">
               <i class="{{ Config::get('buttons.unpublished') }}"></i>
               Unpublished Posts
               <span class="badge badge-secondary border float-right">{{ App\Models\Posts\Post::unpublished()->count() }}</span>
            </a>

            <a href="{{ route('admin.posts.newPosts') }}"
               class="list-group-item list-group-item-action p-1 {{ Route::is('admin.posts.newPosts') ? 'active' : '' }}"
               data-parent="#sub_posts">
               <i class="{{ Config::get('buttons.new') }}"></i>
               New Posts
               <span class="badge badge-secondary border float-right">{{ App\Models\Posts\Post::newPostsCount()->count() }}</span>
            </a>
         @endif

         @if(checkPerm('post_delete'))
            <a href="{{ route('admin.posts.trashed') }}"
               class="list-group-item list-group-item-action p-1 {{ Route::is('admin.posts.trashed') ? 'active' : '' }}"
               data-parent="#sub_posts">
               <i class="{{ Config::get('buttons.trashed') }}"></i>
               Trashed Posts
               <span class="badge badge-secondary border float-right">{{ App\Models\Posts\Post::trashedCount()->count() }}</span>
            </a>
         @endif
      </div>

   </div>
@endif
