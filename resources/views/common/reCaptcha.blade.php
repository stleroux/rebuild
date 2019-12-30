<div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_KEY') }}"></div>
@if($errors->has('g-recaptcha-response'))
   <div {{-- class="invalid-feedback" --}} class="bg-danger" {{-- style="display:block;" --}}>
      <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
   </div>
@endif