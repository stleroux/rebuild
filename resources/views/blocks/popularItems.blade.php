<div class="card mb-2">
   <div class="card-header block_header p-2">
      <i class="far fa-star"></i>
      Most Popular Items
   </div>
   <div class="list-group card_body px-2 text-light">
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


{{--          @if($popularRecipes->count() > 0)
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
         @endif --}}
{{-- @include('blog.blocks.projectsImageSlider')
@include('blog.blocks.popularPosts')
@include('recipes.blocks.popularRecipes') --}}

         {{-- @foreach ($popularWoodProject as $wp)
            <a class="list-group-item" href="{{ route('woodProjects.show', $wp->id) }}" role="button">
               <div class="text text-left">
                  <i class="fa fa-pagelines" aria-hidden="true"></i>
                  Wood Project
                  <span class="badge pull-right">{{ $wp->views }}</span>
               </div>
            </a>
         @endforeach --}}
      {{-- </ul> --}}

   </div>
</div>
