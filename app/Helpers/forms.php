<?php

//
// Use {!! hidden() !!} on <select> fields
// Use {!! disabled() !!} on <select fields
// 
// Use {!! hidden() !!} on form-group objects
//


function disabled()
{
   // Check if last segment of route is equal to 'show'
   if(last(request()->segments()) === 'show')
   {
      // if yes, add disabled to the parameters list
      return " disabled";
   }
}

function hidden()
{
   // Check if last segment of route is equal to 'show'
   if(last(request()->segments()) === 'show')
   {
      // if yes, add the style to hide the control
      return "style=\"display:none\"";
   }
}