<div class="card mb-2">
   <div class="card-header card_header p-2">Profile Image</div>
   <div class="card-body section_body p-2">
      <div class="form-row">
         <div class="col text-center">
            @if ($user->image)
               {{ Html::image("_profiles/" . $user->image, "", array('height'=>'125','width'=>'125')) }}
            @else
               {{ Html::image("_profiles/no_photo.jpg", "", array('height'=>'125','width'=>'125')) }}
            @endif
         </div>
      </div>
      <div class="form-row">
         <div class="col">
            <div class="input-group py-3">
               <label class="btn btn-sm btn-block btn-primary" for="image">
                  <input id="image" name="image" type="file" style="display:none" 
                     onchange="$('#upload-file-info').html(this.files[0].name)">
                  @if(!$user->image)
                     Select Image
                  @else
                     Change Image
                  @endif
               </label>
               <span class='label label-info' id="upload-file-info"></span>
               @if($user->image)
                  <a href="{{ route('profile.deleteImage', $user->id) }}" class="btn btn-sm btn-block btn-danger">Delete Image</a>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
