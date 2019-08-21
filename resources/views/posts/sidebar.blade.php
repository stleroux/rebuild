<div class="card mb-2">
   <div class="card-header block_header p-2">
      <i class="far fa-newspaper"></i>
      Posts
   </div>
   
   <div class="list-group pt-0 pb-0">

      <a href="{{ route('posts.index') }}"
         class="list-group-item list-group-item-action p-1 {{ Route::is('posts.index', 'posts.index.*') ? 'active' : '' }}"
         data-parent="#sub_posts">
         <i class="fas fa-upload pl-2"></i>
         Published Posts
         <span class="badge badge-secondary border float-right">{{ App\Models\Post::published()->count() }}</span>
      </a>

      <a href="{{ route('posts.unpublished') }}"
         class="list-group-item list-group-item-action p-1 {{ Route::is('posts.unpublished', 'posts.unpublished.*') ? 'active' : '' }}"
         data-parent="#sub_posts">
         <i class="fas fa-download pl-2"></i>
         Unpublished Posts
         <span class="badge badge-secondary border float-right">{{ App\Models\Post::unpublished()->count() }}</span>
      </a>

      <a href="{{ route('posts.newPosts') }}"
         class="list-group-item list-group-item-action p-1 {{ Route::is('posts.newPosts') ? 'active' : '' }}"
         data-parent="#sub_posts">
         <i class="fas fa-dot-circle pl-2"></i>
         New Posts
         <span class="badge badge-secondary border float-right">{{ App\Models\Post::newPostsCount()->count() }}</span>
      </a>

      <a href="{{ route('posts.trashed') }}"
         class="list-group-item list-group-item-action p-1 {{ Route::is('posts.trashed') ? 'active' : '' }}"
         data-parent="#sub_posts">
         <i class="far fa-trash-alt pl-2"></i>
         Trashed Posts
         <span class="badge badge-secondary border float-right">{{ App\Models\Post::trashedCount()->count() }}</span>
      </a>
      
   </div>

</div>
