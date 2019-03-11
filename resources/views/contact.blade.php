@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section ('content')

   @include('errors.construction')

   <div class="card mb-2">

      <div class="card-header card_header">
            <i class="fa fa-phone" aria-hidden="true"></i>
            Contact Us
      </div>
      
      <div class="card-body card_body">
         <form action="{{-- {{ route('postContact') }} --}}" method="POST" class="px-0 py-2">
            {{ csrf_field() }}
            <!-- Use url() instead of route() when there is no named route -->
         
            <div class="form-group py-0 {{ $errors->has('email') ? 'has-error' : '' }}">
               {{ Form::label('email', 'Email', ['class'=>'required']) }}
               <input id="email" name="email" class="form-control form-control-sm" autofocus="autofocus" value="{{ old('email') }}">
               <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
            
            <div class="form-group py-0 {{ $errors->has('subject') ? 'has-error' : '' }}">
               {{ Form::label('subject', 'Subject', ['class'=>'required']) }}
               <input id="subject" name="subject" class="form-control form-control-sm" value="{{ old('subject') }}">
               <span class="text-danger">{{ $errors->first('subject') }}</span>
            </div>
            
            <div class="form-group py-0 {{ $errors->has('message') ? 'has-error' : '' }}">
               {{ Form::label('message', 'Message', ['class'=>'required']) }}
               <textarea id="message" name="message" class="form-control form-control-sm" placeholder="Type your message here" rows="5">{{ old('message') }}</textarea>
               <span class="text-danger">{{ $errors->first('message') }}</span>
            </div>

            <input type="submit" value="Send Message" class="btn btn-sm btn-success btn-block" disabled="disabled">
               {{-- <i class="fa fa-envelope-o" aria-hidden="true"></i> --}}

            <div class="g-recaptcha" data-sitekey="6LduZyYTAAAAANM_G6pjSZs4O61YJpVDPlLABw11"></div>
         </form>
      </div>

      <div class="card-footer pt-1 pb-1 pl-2">
         Fields marked with an <span class="required"></span> are required
      </div>

   </div>

@endsection
