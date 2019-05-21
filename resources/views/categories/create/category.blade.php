   {!! Form::open(['route' => 'categories.store']) !!}
      <input type="hidden" name="part" value="category">
      <div class="card mb-3">
         <div class="card-header card_header">
            <i class="fa fa-plus" aria-hidden="true"></i>
            New Category
            <span class="float-right">
               @include('common.buttons.help', ['bookmark'=>'categories_add_category'])
               {{-- @include('common.buttons.cancel', ['name'=>'category', 'model'=>$category]) --}}
               @include('common.buttons.reset', ['model'=>'category'])
               @include('common.buttons.save', ['model'=>'category'])
            </span>
         </div>
         <div class="card-body card_body pb-0">
            <div class="row">
               <div class="col-3">
                  <div class="form-group {{ $errors->has('cCategory') ? 'has-error' : '' }}">
                     {!! Form::label('cCategory','Main Category', ['class'=>'required']) !!}
                     <select name="cCategory" id="category" class="form-control input-sm">
                        <option value="">Select One</option>
                        @foreach($categories as $k)
                           <option value="{{ $k['id'] }}">{{ ucwords($k['name']) }}</option>
                        @endforeach
                     </select>
                     <span class="text-danger">{{ $errors->first('cCategory') }} </span>
                  </div>
               </div>

               <div class="col-3">
                  <div class="form-group {{ $errors->has('cSubcategory') ? 'has-error' : '' }}">
                     {!! Form::label('cSubcategory','Sub Category', ['class'=>'required']) !!}
                     <select name="cSubcategory" id="subcategory" class="form-control input-sm">
                        <option value=""></option>
                     </select>
                     <span class="text-danger">{{ $errors->first('cSubcategory') }} </span>
                  </div>
               </div>

               <div class="col-3">
                  <div class="form-group {{ $errors->has('cName') ? 'has-error' : '' }}">
                     {{ Form::label('cName', 'Category Name', ['class'=>'required']) }}
                     {{ Form::text('cName', null, ['class' => 'form-control form-control-sm']) }}
                     <small id="passwordHelpBlock" class="form-text text-muted">
                        Use camelCase for categories with multiple words. I.E.: fruitDishes, hotSoups
                     </small>
                     <span class="text-danger">{{ $errors->first('cName') }}</span>
                  </div>
               </div>
               <div class="col-3">
                  <div class="form-group {{ $errors->has('cValue') ? 'has-error' : '' }}">
                     {{ Form::label('cValue', 'Value') }}
                     {{ Form::text('cValue', null, ['class' => 'form-control form-control-sm', 'placeholder'=>'See Category Help for details.']) }}
                     <span class="text-danger">{{ $errors->first('cValue') }}</span>
                  </div>
               </div>
               <div class="w-100"></div>
               <div class="col">
                  <div class="form-group {{ $errors->has('cDescription') ? 'has-error' : '' }}">
                     {{ Form::label('cDescription', 'Description') }}
                     {{ Form::text('cDescription', null, ['class' => 'form-control form-control-sm']) }}
                     <span class="text-danger">{{ $errors->first('cDescription') }}</span>
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