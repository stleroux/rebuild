<div class="row">

   <div class="col-sm-12 col-md-6">
      <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
         {{-- <strong>userName:</strong> --}}
         {{ Form::label('username', 'Username', ['class'=>'required']) }}
         {!! Form::text('username', null, array('placeholder'=>'Username', 'class'=>'form-control form-control-sm', ($disabled?'disabled':''), 'autofocus'=>'autofocus' )) !!}
         <span class="text-danger">{{ $errors->first('username') }}</span>
      </div>
   </div>


   <div class="col-sm-12 col-md-6">
      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
         {{ Form::label('email', 'Email', ['class'=>'required']) }}
         {{-- <strong>Email:</strong> --}}
         {!! Form::text('email', null, array('placeholder'=>'Email', 'class'=>'form-control form-control-sm', ($disabled?'disabled':'') )) !!}
         <span class="text-danger">{{ $errors->first('email') }}</span>
      </div>
   </div>

</div>