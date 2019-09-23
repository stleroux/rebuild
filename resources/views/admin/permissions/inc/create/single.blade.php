{!! Form::open(array('route' => 'admin.permissions.store')) !!}
   <input type="hidden" name="single" value="single">
   <div class="card mb-3">
      <!--CARD HEADER-->
      <div class="card-header card_header p-2">
         <i class="fas fa-user"></i>
         Add Single Permission
         <span class="float-sm-right">
            <div class="btn-group">
               @include('admin.permissions.buttons.back', ['size'=>'xs'])
               @include('admin.permissions.buttons.reset', ['size'=>'xs'])
               @include('admin.permissions.buttons.save&new', ['size'=>'xs'])
               @include('admin.permissions.buttons.save', ['size'=>'xs'])
            </div>
         </span>
      </div>
      <div class="card-body section_body p-2">
         <div class="row">
            <div class="col-sm-4">
               <div class="form-group">
                  {{ Form::label('name', 'Name', ['class'=>'required']) }}
                  {!! Form::text('name', null, array('class'=>'form-control form-control-sm', 'autofocus'=>'autofocus')) !!}
                  <div class="pl-1 bg-danger">{{ $errors->first('name') }}</div>
                  <small class="form-text">Will be used in code</small>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group">
                  {{ Form::label('display_name', 'Display Name', ['class'=>'required']) }}
                  {!! Form::text('display_name', null, array('class'=>'form-control form-control-sm')) !!}
                  <div class="pl-1 bg-danger">{{ $errors->first('display_name') }}</div>
                  <small class="form-text">As displayed in user interface</small>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="form-group">
                  {{ Form::label('model', 'Model', ['class'=>'required']) }}
                  {!! Form::text('model', null, array('class'=>'form-control form-control-sm')) !!}
                  <div class="pl-1 bg-danger">{{ $errors->first('model') }}</div>
                  <small class="form-text">Used for sorting and grouping permissions</small>
               </div>
            </div>
{{--             <div class="col-sm-4">
               <div class="form-group">
                  <label for="type" class="required">Core Module?</label>
                     <select name="type" value="{{ old('type') ?? $permission->type }}" id="type" class="form-control form-control-sm">
                        @foreach($permission->typesOptions() as $typeOptionKey => $typeOptionValue)
                           <option value="{{ $typeOptionKey }}" {{ $permission->type == $typeOptionValue ? 'selected' : '' }}>{{ $typeOptionValue }}</option>
                        @endforeach
                     </select>
                  <div class="pl-1 bg-danger">{{ $errors->first('type') }}</div>
               </div>
            </div> --}}
            <div class="col-sm-12">
               <div class="form-group">
                  {{ Form::label('description', 'Allow member to', ['class'=>'required']) }}
                  {!! Form::text('description', null, array('class'=>'form-control form-control-sm')) !!}
                  <div class="pl-1 bg-danger">{{ $errors->first('description') }}</div>
               </div>
            </div>
         </div>
      </div>
   </div>
{{ Form::close() }}