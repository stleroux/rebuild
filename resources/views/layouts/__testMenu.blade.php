<div class="list-group py-0 px-0" id="sidebar">
   
   <a href="#" class="list-group-item list-group-item-action py-1 px-1" data-parent="#sidebar">
      <i class="fas fa-home pl-2"></i>
      Home
   </a>

   <a href="#" class="list-group-item list-group-item-action py-1 px-1" data-parent="#sidebar">
      <i class="fas fa-blog pl-2"></i>
      Blog
   </a>

   <a href="#menu1" class="list-group-item list-group-item-action py-1 px-1" data-toggle="collapse">
      <i class="fab fa-apple pl-2"></i>
      Recipes
      <i class="fa fa-caret-down"></i>
   </a>
      <div class="collapse" id="menu1" data-parent="#sidebar">
         <a href="#menu1sub1" class="list-group-item" data-toggle="collapse">
            By Categories <i class="fa fa-caret-down"></i>
         </a>
            <div class="collapse" id="menu1sub1" data-parent="#menu1sub1">
               @foreach ($categories as $category)
      <a href="{{ route('recipes.index', $category->name) }}"
         class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('recipes/' . $category->name) ? 'active' : '' }} {{ Request::is('recipes/' . $category->name . '/*') ? 'active' : '' }}">
         <i class="fas fa-angle-right pl-3"></i>
         {{ ucfirst($category->name) }}
      </a>
      @foreach ($category->children as $children)
         <a href="{{ route('recipes.index', $children->name) }}"
            class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('recipes/' . $children->name . '*') ? 'active' : '' }}">
            <i class="fas fa-angle-double-right pl-4"></i>
            {{ ucfirst($children->name) }}
         </a>
      @endforeach
   @endforeach
               <a href="#" class="list-group-item">
                  2.1.1
               </a>
               
            </div>
         <a href="#" class="list-group-item" data-parent="#menu1">
            2.2
         </a>
         <a href="#" class="list-group-item" data-parent="#menu1">
            2.3
         </a>
      </div>
   <a href="#" class="list-group-item" data-parent="#sidebar">
      3
   </a>
   <a href="#menu3" class="list-group-item" data-toggle="collapse">
      4 <i class="fa fa-caret-down"></i>
   </a>
      <div class="collapse" id="menu3"  data-parent="#sidebar">
         <a href="#" class="list-group-item">
            4.1
         </a>
         <a href="#menu3sub2" class="list-group-item" data-toggle="collapse">
            4.2 <i class="fa fa-caret-down"></i>
         </a>
            <div class="collapse" id="menu3sub2" data-parent="#menu3">
               <a href="#" class="list-group-item">
                  4.2.1
               </a>
               <a href="#" class="list-group-item">
                  4.2.2
               </a>
               <a href="#" class="list-group-item">
                  4.2.3
               </a>
            </div>
         <a href="#" class="list-group-item" data-parent="#menu3">
            4.3
         </a>
      </div>
   <a href="#" class="list-group-item" data-parent="#sidebar">
      5
   </a>
   <a href="#" class="list-group-item" data-parent="#sidebar">
      6
   </a>
</div>
