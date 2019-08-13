<div class="card mb-2">
   <div class="card-header card_header p-2">Profile Image</div>
   <div class="card-body section_body p-2">
      <div class="form-row">
         <div class="col text-center">
            @if ($user->image)
               {{ Html::image("_profiles/" . $user->image, "",array('height'=>'125','width'=>'125')) }}
            @else
               {{ Html::image("_profiles/no_photo.jpg", "", array('height'=>'125','width'=>'125')) }}
            @endif
         </div>
      </div>
   </div>
</div>
