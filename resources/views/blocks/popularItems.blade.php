<div class="card mb-2">
   <div class="card-header block_header">
      <i class="far fa-star" aria-hidden="true"></i>
      MOST POPULAR ITEMS
   </div>
   <div class="list-group card_body px-2">
      <p>Have a look at the most viewed items on the site.</p>

{{--       <ul class="list-group">
         @if(!empty($popularArticle))
            @foreach ($popularArticle as $a)
               <a class="list-group-item" href="{{ route('articles.show', $a->id) }}" role="button">
                  <div class="text text-left">
                     <i class="fa fa-file-text-o" aria-hidden="true"></i>
                     Article
                     <span class="badge pull-right">{{ $a->views }}</span>
                  </div>
               </a>
            @endforeach
         @endif
--}}
{{-- {{ setting('homepage_favorite_post_count') }} \
{{ setting('homepage_favorite_recipe_count') }} --}}

         @if($popularPosts->count() > 0)
            <div class="card mb-2">
               <div class="card-header">POPULAR BLOG</div>
               <div class="card-body p-0 m-0">
                  @foreach ($popularPosts as $b)
                     <a class="list-group-item p-1 m-0" href="{{ route('blog.single', $b->slug) }}" role="button">
                        <div class="text text-left">
                           <i class="far fa-address-card"></i>
                           {{ $b->title }}
                           <span class="badge badge-danger float-right">{{ $b->views }}</span>
                        </div>
                     </a>
                  @endforeach
               </div>
            </div>
         @endif

         @if($popularRecipes->count() > 0)
            <div class="card mb-2">
               <div class="card-header">POPULAR RECIPES</div>
               <div class="card-body p-0 m-0">
                  @foreach ($popularRecipes as $r)
                     <a class="list-group-item p-1 m-0" href="{{ route('recipes.show', $r->id) }}" role="button">
                        <div class="text text-left">
                           <i class="far fa-address-card"></i>
                           {{ $r->title }}
                           <span class="badge badge-danger float-right">{{ $r->views }}</span>
                        </div>
                     </a>
                  @endforeach
               </div>
            </div>
         @endif

         {{-- @foreach ($popularWoodProject as $wp)
            <a class="list-group-item" href="{{ route('woodProjects.show', $wp->id) }}" role="button">
               <div class="text text-left">
                  <i class="fa fa-pagelines" aria-hidden="true"></i>
                  Wood Project
                  <span class="badge pull-right">{{ $wp->views }}</span>
               </div>
            </a>
         @endforeach --}}
      </ul>

   </div>
</div>
