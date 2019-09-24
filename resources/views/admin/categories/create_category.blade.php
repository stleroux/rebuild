{{-- {!! Form::open(['route' => 'admin.categories.store']) !!} --}}
{{-- <form action="{{ route('admin.categories.store') }}"> --}}
<form>
   @csrf
   <input type="hidden" name="part" value="category">
   <div class="card mb-2">
      <div class="card-header section_header p-2">
         <i class="fa fa-plus" aria-hidden="true"></i>
         New Category
         <span class="float-right">
            <div class="btn-group">
               @include('admin.categories.buttons.help', ['size'=>'xs', 'bookmark'=>'categories_add_category'])
               @include('admin.categories.buttons.back', ['size'=>'xs'])
               @include('admin.categories.buttons.reset', ['size'=>'xs'])
               @include('admin.categories.buttons.save', ['size'=>'xs'])
            </div>
         </span>
      </div>
      <div class="card-body section_body p-2">
         <div class="form-row">
            <div class="col-3">
               <div class="form-group">
                  <label for="category" class="required">Main Category</label>
                  <select name="cCategory" id="category" class="form-control form-control-sm">
                     <option value="">Select One</option>
                     @foreach($categories as $k)
                        <option value="{{ $k['id'] }}">{{ ucwords($k['name']) }}</option>
                     @endforeach
                  </select>
                  <div class="pl-1 bg-danger">{{ $errors->first('cCategory') }}</div>
               </div>
            </div>

            <div class="col-3">
               <div class="form-group">
                  <label for="subcategory" class="required">Sub Category</label>
                  <select name="cSubcategory" id="subcategory" class="form-control form-control-sm capitalize">
                     <option value=""></option>
                  </select>
                  <div class="pl-1 bg-danger">{{ $errors->first('cSubcategory') }} </div>
               </div>
            </div>

            <div class="col-3">
               <div class="form-group">
                  <label for="cName" class="required">Category Name</label>
                  <input type="text" name="cName" class="form-control form-control-sm required" />
                  <div class="pl-1 bg-danger">{{ $errors->first('cName') }}</div>
                  <small id="passwordHelpBlock" class="form-text text-dark">
                     Use camelCase for categories with multiple words. I.E.: fruitDishes, hotSoups
                  </small>
               </div>
            </div>
            <div class="col-3">
               <div class="form-group">
                  <label for="cValue">Value</label>
                  <input type="text" name="cValue" class="form-control form-control-sm" placeholder="See Category Help for details." />
               </div>
            </div>
            <div class="w-100"></div>
            <div class="col">
               <div class="form-group">
                  <label for="cDescription">Description</label>
                  <input type="text" name="cDescription" class="form-control form-control-sm" />
                  <div class="pl-1 bg-danger">{{ $errors->first('cDescription') }}</div>
               </div>
            </div>
         </div>
      </div>

      <div class="card-footer px-1 py-1">
         <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
      </div>
   </div>
{!! Form::close() !!}


@section('scripts')

   <script>
      $(document).ready(function () { 
         $('#category').on('change',function(e){
            console.log(e);
            var cat_id = e.target.value;
            //ajax
            $.get('/ajax-subcat?cat_id='+ cat_id,function(data){
            //success data
            //console.log(data);
            var subcat =  $('#subcategory').empty();
               $.each(data,function(create,subcatObj){
                  var option = $('<option/>', {id:create, value:subcatObj});
                  subcat.append('<option value ="'+subcatObj+'">'+subcatObj+'</option>');
               });
            });
         });
      });
   </script>

@endsection