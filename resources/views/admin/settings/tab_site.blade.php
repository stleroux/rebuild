<div class="container-fluid px-0 py-1">
   <div class="row p-0">   
      @foreach($site as $setting)
         <div class="col-md-4 p-1">
            <div class="card">
               <div class="card-header card_header p-2">{{ $setting->key }}</div>
               <div class="card-body card_body p-2">
                  <div class="input-group input-group-sm">
                     <input type="hidden" name="id[]" value="{{ $setting->id }}" />
                     <input type="text" class="form-control form-control-sm" id="{{ $setting->key }}" name="value[]" value="{{ $setting->value }}">
                     <div class="input-group-append">
                        @include('admin.settings.buttons.edit', ['size'=>'xs'])
                        @include('admin.settings.buttons.delete', ['size'=>'xs'])
                     </div>
                  </div>
               </div>
               <div class="card-footer p-0 pl-1">
                  <small class="help-text">{{ $setting->description }}</small>
               </div>
            </div>
         </div>
      @endforeach
   </div>
</div>
