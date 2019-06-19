<div class="card">
   <div class="card-body pt-2 pb-0">
      <div class="row">
         <div class="col-sm-12 col-md-2">
            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
               {{ Form::label('username', 'Username', ['class'=>'required']) }}
               {!! Form::text('username', null, array('placeholder'=>'Username', 'class'=>'form-control form-control-sm', 'autofocus'=>'autofocus' )) !!}
               <span class="text-danger">{{ $errors->first('username') }}</span>
            </div>
         </div>

         <div class="col-sm-12 col-md-3">
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
               {{ Form::label('email', 'Email', ['class'=>'required']) }}
               {!! Form::text('email', null, array('placeholder'=>'Email', 'class'=>'form-control form-control-sm' )) !!}
               <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
         </div>

         <div class="col-sm-12 col-md-3">
            <div class="form-group">
               {{ Form::label('password', 'Password', ['class'=>'required']) }}
               {!! Form::text('password', null, array('placeholder'=>'Automatically set to :: password', 'class'=>'form-control form-control-sm', 'readonly'=>'readonly')) !!}
            </div>
         </div>
      </div>
   </div>
</div>