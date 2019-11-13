<div class="card mb-1">
   
   <div class="card-header card_header p-1">
      <i class="fas fa-chart-pie"></i>
      Site Statistics
   </div>
         
   <div class="card-body card_body p-1">
      <div class="col p-0">
         <div class="list-group">
            <div class="list-group-item p-1">
               <i class="fas fa-fw fa-sitemap"></i>
               Categories
               <span class="badge badge-secondary float-right">
                  {{ App\Models\Category::count() }}
               </span>
            </div>

            <div class="list-group-item p-1">
               <i class="fas fa-fw fa-comments"></i>
               Comments
               <span class="badge badge-secondary float-right">
                  {{ App\Models\Comment::count() }}
               </span>
            </div>

            <div class="list-group-item p-1">
               <i class="fas fa-fw fa-users"></i>
               Members
               <span class="badge badge-secondary float-right">
                  {{ App\Models\User::count() }}
               </span>
            </div>

            <div class="list-group-item p-1">
               <i class="fas fa-fw fa-shield-alt"></i>
               Permissions
               <span class="badge badge-secondary float-right">
                  {{ App\Models\Permission::count() }}
               </span>
            </div>

            <div class="list-group-item p-1">
               <i class="fas fa-fw fa-newspaper"></i>
               Posts
               <span class="badge badge-secondary float-right">
                  {{ App\Models\Posts\Post::count() }}
               </span>
            </div>

            <div class="list-group-item p-1">
               <i class="fab fa-fw fa-pagelines"></i>
               Projects
               <span class="badge badge-secondary float-right">
                  {{ App\Models\Projects\Project::count() }}
               </span>
            </div>

            <div class="list-group-item p-1">
               <i class="fab fa-fw fa-apple"></i>
               Recipes
               <span class="badge badge-secondary float-right">
                  {{ App\Models\Recipes\Recipe::count() }}
               </span>
            </div>
         </div>
      </div>
   </div>

   <div class="card-footer p-1">
      Statistics footer text goes here
   </div>

</div>
