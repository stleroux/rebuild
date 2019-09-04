@if(Setting('sessions') === "yes")
   <div class="card mb-2">
      <div class="card-header block_header p-2">Session Variables</div>
      <div class="card-body p-2">
         <span class="bg-dark text-light">
            fromPage : {{ Session::get('fromPage') }} <br />
            fromLocation : {{ Session::get('fromLocation') }}
         </span>
      </div>
   </div>
@endif
