<div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_KEY') }}"></div>
@if($errors->has('g-recaptcha-response'))
   <span class="invalid-feedback" style="display:block;">
      <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
   </span>
@endif