   {!! Form::open(['route' => 'categories.store']) !!}
      <input type="hidden" name="part" value="sub">
      <div class="card mb-3">
         <div class="card-header card_header">
            <i class="fa fa-plus" aria-hidden="true"></i>
            New Sub Category
            <span class="float-right">
               @include('common.buttons.help', ['model'=>'category', 'type'=>''])
               @include('categories.blocks.help', ['model'=>'category', 'type'=>''])
               @include('common.buttons.cancel', ['model'=>'category', 'type'=>''])
               @include('common.buttons.reset', ['model'=>'category', 'type'=>''])
               @include('common.buttons.save', ['model'=>'category', 'type'=>''])
            </span>
         </div>
         <div class="card-body card_body pb-0">
            <div class="row">
               <div class="col-3">
                  <div class="form-group {{ $errors->has('sSubs') ? 'has-error' : '' }}">
                     {!! Form::label('sSubs','Sub Category', ['class'=>'required']) !!}
                     <select name="sSubs" id="subs" class="form-control input-sm">
                        <option value="">Select One</option>
                        @foreach($categories as $k)
                           <option value="{{ $k['id'] }}">{{ ucwords($k['name']) }}</option>
                        @endforeach
                     </select>
                     <span class="text-danger">{{ $errors->first('sSubs') }} </span>
                  </div>
               </div>

{{--                <div class="col-3">
                  <div class="form-group {{ $errors->has('subcategory') ? 'has-error' : '' }}">
                     {!! Form::label('subs','Sub Category') !!}
                     <select name="subs" id="subs" class="form-control input-sm">
                        <option value=""></option>
                     </select>
                     <span class="text-danger">{{ $errors->first('subcategory') }} </span>
                  </div>
               </div> --}}

               <div class="col-3">
                  <div class="form-group {{ $errors->has('sName') ? 'has-error' : '' }}">
                     {{ Form::label('sName', 'Category Name', ['class'=>'required']) }}
                     {{ Form::text('sName', null, ['class' => 'form-control form-control-sm']) }}
                     <span class="text-danger">{{ $errors->first('sName') }}</span>
                  </div>
               </div>
               <div class="col-3">
                  <div class="form-group {{ $errors->has('sValue') ? 'has-error' : '' }}">
                     {{ Form::label('sValue', 'Value') }}
                     {{ Form::text('sValue', null, ['class' => 'form-control form-control-sm', 'placeholder'=>'See Category Help for details.']) }}
                     <span class="text-danger">{{ $errors->first('sValue') }}</span>
                  </div>
               </div>
               <div class="w-100"></div>
               <div class="col">
                  <div class="form-group {{ $errors->has('sDescription') ? 'has-error' : '' }}">
                     {{ Form::label('sDescription', 'Description') }}
                     {{ Form::text('sDescription', null, ['class' => 'form-control form-control-sm']) }}
                     <span class="text-danger">{{ $errors->first('sDescription') }}</span>
                  </div>
               </div>
            </div>
         </div>

         <div class="card-footer px-1 py-1">
            <div>Fields with <i class="fa fa-star" style="color:#ff0000" aria-hidden="true"></i> are required</div>
         </div>
      </div>
   {!! Form::close() !!}