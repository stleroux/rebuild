   {!! Form::open(['route' => 'categories.store']) !!}
      <input type="hidden" name="part" value="main">
      <div class="card mb-3">
         <div class="card-header card_header">
            <i class="fa fa-plus" aria-hidden="true"></i>
            New Parent Category
            <span class="float-right">
               @include('common.buttons.help', ['bookmark'=>'categories_add_mainCategory'])
               {{-- @include('help.categories.create.mainCategory', ['model'=>'category', 'model'=>$category]) --}}
               {{-- @include('common.buttons.cancel', ['name'=>'category', 'model'=>$category]) --}}
               @include('common.buttons.reset', ['model'=>'category'])
               @include('common.buttons.save', ['model'=>'category'])
            </span>
         </div>
         <div class="card-body card_body pb-0">
            <div class="row">
               {{-- <div class="col-3">
                  <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                     {!! Form::label('category','Main Category') !!}
                     <select name="category" id="category" class="form-control input-sm", autofocus="autofocus">
                        <option value="">Select One</option>
                        @foreach($categories as $k)
                           <option value="{{ $k['id'] }}">{{ ucwords($k['name']) }}</option>
                        @endforeach
                     </select>
                     <span class="text-danger">{{ $errors->first('category') }} </span>
                  </div>
               </div> --}}

{{--                <div class="col-3">
                  <div class="form-group {{ $errors->has('subcategory') ? 'has-error' : '' }}">
                     {!! Form::label('subcategory','Sub Category') !!}
                     <select name="subcategory" id="subcategory" class="form-control input-sm">
                        <option value=""></option>
                     </select>
                     <span class="text-danger">{{ $errors->first('subcategory') }} </span>
                  </div>
               </div> --}}

               <div class="col-3">
                  <div class="form-group {{ $errors->has('mName') ? 'has-error' : '' }}">
                     {{ Form::label('mName', 'Main Category', ['class'=>'required']) }}
                     {{ Form::text('mName', null, ['class' => 'form-control form-control-sm']) }}
                     <span class="text-danger">{{ $errors->first('mName') }}</span>
                  </div>
               </div>
               <div class="col-3">
                  <div class="form-group {{ $errors->has('mValue') ? 'has-error' : '' }}">
                     {{ Form::label('mValue', 'Value') }}
                     {{ Form::text('mValue', null, ['class' => 'form-control form-control-sm', 'placeholder'=>'See Category Help for details.']) }}
                     <span class="text-danger">{{ $errors->first('mValue') }}</span>
                  </div>
               </div>
               <div class="w-100"></div>
               <div class="col">
                  <div class="form-group {{ $errors->has('mDescription') ? 'has-error' : '' }}">
                     {{ Form::label('mDescription', 'Description') }}
                     {{ Form::text('mDescription', null, ['class' => 'form-control form-control-sm']) }}
                     <span class="text-danger">{{ $errors->first('mDescription') }}</span>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-footer px-1 py-1">
            <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
         </div>
      </div>
   {!! Form::close() !!}