{!! Form::open(array('route' => 'permissions.store')) !!}

   <div class="card mb-3">
      <!--CARD HEADER-->
      <div class="card-header card_header p-2">
         <i class="fas fa-user"></i>
         Add Single Permission
         <span class="float-sm-right">
            @include('permissions.buttons.back', ['size'=>'xs'])
            @include('permissions.buttons.reset', ['size'=>'xs'])
            @include('permissions.buttons.save&new', ['size'=>'xs'])
            @include('permissions.buttons.save', ['size'=>'xs'])
         </span>
      </div>
      <div class="card-body section_body p-2">
         <div class="row">
            <div class="col-sm-4">
               <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                  {{ Form::label('name', 'Name', ['class'=>'required']) }}
                  {!! Form::text('name', null, array('class'=>'form-control form-control-sm', 'autofocus'=>'autofocus')) !!}
                  <small class="form-text">Will be used in code</small>
                  <span class="bg-danger text-dark">{{ $errors->first('name') }}</span>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group {{ $errors->has('display_name') ? 'has-error' : '' }}">
                  {{ Form::label('display_name', 'Display Name', ['class'=>'required']) }}
                  {!! Form::text('display_name', null, array('class'=>'form-control form-control-sm')) !!}
                  <small class="form-text">As displayed in user interface</small>
                  <span class="bg-danger text-dark">{{ $errors->first('display_name') }}</span>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
                  {{ Form::label('model', 'Model', ['class'=>'required']) }}
                  {!! Form::text('model', null, array('class'=>'form-control form-control-sm')) !!}
                  <small class="form-text">Used for sorting and grouping permissions</small>
                  <span class="bg-danger text-dark">{{ $errors->first('model') }}</span>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                  <label for="type" class="required">Core Module?</label>
                     <select name="type" value="{{ old('type') ?? $permission->type }}" id="type" class="form-control form-control-sm">
                        @foreach($permission->typesOptions() as $typeOptionKey => $typeOptionValue)
                           <option value="{{ $typeOptionKey }}" {{ $permission->type == $typeOptionValue ? 'selected' : '' }}>{{ $typeOptionValue }}</option>
                        @endforeach
                     </select>
                  <span class="bg-danger text-dark">{{ $errors->first('type') }}</span>
               </div>
            </div>
            <div class="col-sm-12">
               <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                  {{ Form::label('description', 'Allow member to', ['class'=>'required']) }}
                  {!! Form::text('description', null, array('class'=>'form-control form-control-sm')) !!}
                  <small class="form-text"></small>
                  <span class="bg-danger text-dark">{{ $errors->first('description') }}</span>
               </div>
            </div>
         </div>
      </div>
   </div>
{{ Form::close() }}