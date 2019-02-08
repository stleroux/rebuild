<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
   {{ Form::label ('title', 'Title', ['class'=>'required']) }}
   {{ Form::text ('title', null, ['class' => 'form-control form-control-sm']) }}
   <span class="text-danger">{{ $errors->first('title') }}</span>
</div>