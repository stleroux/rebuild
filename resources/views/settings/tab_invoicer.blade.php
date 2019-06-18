@foreach($invoicer->chunk(3) as $chunk)
   <div class="card-deck">
      @foreach($chunk as $r)
         <div class="col-4 p-0">
            <div class="card my-3">
               <div class="card-body">
                  <div class="form-row">
                     <div class="form-group col mb-0">
                        <label for="{{ $r->key }}">{{ $r->key }}</label>
                        <div class="input-group input-group-sm">
                           <input type="hidden" name="id[]" value="{{ $r->id }}" />
                           <input type="text" class="form-control form-control-sm" id="{{ $r->key }}" name="value[]" value="{{ $r->value }}">
                           <div class="input-group-append">
                              <a href="{{ route('settings.edit', $r->id) }}" class="btn btn-sm btn-primary">
                                 <i class="far fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <small class="help-text">{{ $r->description }}</small>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      @endforeach
   </div>
@endforeach