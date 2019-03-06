
field_name = title
required = y/n
autofocus = y/n
 

<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}" >
   {!! Form::label("title", "Title", ['class'=>'required']) !!}
   {{ Form::text ('title', null, array('class' => 'form-control', 'autofocus'=>'autofocus')) }}
      <span class="text-danger">{{ $errors->first('title') }}</span>
</div>