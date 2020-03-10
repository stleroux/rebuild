<div class="card">

   <div class="card-header card_header_2 p-2">Tree List</div>

   <div class="card-body">


<div class="accordion" id="accordionExample">
  
  @foreach ($categories as $category)
     <div class="card">
       <div class="card-header p-1 m-0" id="heading{{$category->id}}">
           <div class="btn btn-sm btn-link btn-block p-0 m-0" type="button" data-toggle="collapse" data-target="#collapse{{$category->id}}" aria-expanded="true" aria-controls="collapse{{$category->id}}">
              {{ ucfirst($category->name) }}
           </div>
       </div>

       <div id="collapse{{$category->id}}" class="collapse" aria-labelledby="heading{{$category->id}}" data-parent="#accordionExample">
         <div class="card-body">
            @foreach ($category->children as $childCategory)
               {{-- {{ dd($childCategory) }} --}}
               {{-- @include('admin.categories.blocks.child_category', ['child_category' => $childCategory]) --}}
            @endforeach
         </div>
       </div>
     </div>
  @endforeach

</div>



      {{-- <ul class="p-0">
         @foreach ($categories as $category)
            <li>{{ ucfirst($category->name) }}</li>
            <ul>
               @foreach ($category->childrenCategories as $childCategory)
                  @include('admin.categories.blocks.child_category', ['child_category' => $childCategory])
               @endforeach
            </ul>
         @endforeach
      </ul> --}}

   </div>

</div>



