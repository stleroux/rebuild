<select name="" id="">
@foreach ($categories as $category)
   <option value="" disabled>{{ $category->name }}</option>
   {{-- <a href="{{ route('recipes.index', $category->name) }}"
      class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('recipes/' . $category->name) ? 'menu_active' : '' }} {{ Request::is('recipes/' . $category->name . '/*') ? 'menu_active' : '' }}">
      <i class="fas fa-angle-right pl-3"></i>
      {{ ucfirst($category->name) }}
      <!-- {{ deliciousCamelcase(ucfirst($category->name)) }} -->
   </a> --}}
   @foreach ($category->children as $children)
      <option value="">&nbsp;&nbsp;-&nbsp;{{ $children->name }}</option>
      {{-- <a href="{!! route('recipes.index', $children->name) !!}"
         class="list-group-item list-group-item-action py-1 px-1 {{ Request::is('recipes/' . $children->name . '*') ? 'menu_active' : '' }}">
         <i class="fas fa-angle-double-right pl-4"></i>
         <!-- {{ ucfirst($children->name) }} -->
         {!! deliciousCamelcase(ucfirst($children->name)) !!}
      </a> --}}
   @endforeach
@endforeach
</select>