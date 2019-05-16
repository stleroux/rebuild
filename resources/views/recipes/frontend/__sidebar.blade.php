<div class="card mb-2">
   <div class="card-header block_header">
      RECIPES MENU
   </div>

      <a href="{{ route('recipes.index', 'all') }}"
         class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('recipes/all') ? 'active' : '' }}">
         <i class="fab fa-apple pl-2"></i>
         Recipes
      </a>
      
   @foreach ($categories as $category)
      <a href="{{ route('recipes.index', $category->name) }}"
         class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('recipes/' . $category->name) ? 'active' : '' }}">
         <i class="fas fa-angle-right pl-3"></i>
         {{ ucfirst($category->name) }}
      </a>
      @foreach ($category->children as $children)
         <a href="{{ route('recipes.index', $children->name) }}"
            class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('recipes/' . $children->name) ? 'active' : '' }}">
            <i class="fas fa-angle-double-right pl-4"></i>
            {{ ucfirst($children->name) }}
         </a>
      @endforeach
   @endforeach
</div>
