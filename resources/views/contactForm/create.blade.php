@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
@endsection

@section ('content')

   <div class="card mb-2">

      <div class="card-header section_header p-2">
            <i class="fa fa-phone"></i>
            Contact Us
      </div>
      
      <div class="card-body section_body p-2">
         <form action="/contact" method="POST" class="px-0 py-2">
   
            @csrf
            
            <div class="form-group py-0">
               {{ Form::label('subject', 'Subject', ['class'=>'required']) }}
               <input id="subject" name="subject" class="form-control form-control-sm" autofocus="autofocus" value="{{ old('subject') }}">
               <div class="bg-danger">{{ $errors->first('subject') }}</div>
            </div>

            @if(Auth::user())
               <div class="form-group py-0">
                  {{ Form::label('email', 'Email', ['class'=>'required']) }}
                  <input id="email" name="email" class="form-control form-control-sm" readonly="readonly" value="{{ Auth::user()->email }}">
                  <div class="bg-danger">{{ $errors->first('email') }}</div>
               </div>
            @else
               <div class="form-group py-0">
                  {{ Form::label('email', 'Email', ['class'=>'required']) }}
                  <input id="email" name="email" class="form-control form-control-sm" value="{{ old('email') }}">
                  <div class="bg-danger">{{ $errors->first('email') }}</div>
               </div>
            @endif
            
            <div class="form-group py-0">
               {{ Form::label('message', 'Message', ['class'=>'required']) }}
               <textarea id="message" name="message" class="form-control form-control-sm" placeholder="Type your message here" rows="5">{{ old('message') }}</textarea>
               <div class="bg-danger">{{ $errors->first('message') }}</div>
            </div>

            {{-- @include('common.reCaptcha') --}}

            {{-- From : https://itnext.io/stopping-form-spam-in-laravel-76760bf84bd --}}
            <div class="form-group" style="display: none;">
            {{-- <div class="form-group"> --}}
               <label for="faxonly">Fax Only
                  <input type="checkbox" name="faxonly" id="faxonly" />
               </label>
            </div>
            {{-- From : https://itnext.io/stopping-form-spam-in-laravel-76760bf84bd --}}

            <div class="text-center">
               <input type="submit" value="Send Message" class="btn btn-sm btn-primary">
            </div>

         </form>
      </div>

      <div class="card-footer pt-1 pb-1 pl-2">
         Fields marked with an <span class="required"></span> are required
      </div>

   </div>

@endsection
