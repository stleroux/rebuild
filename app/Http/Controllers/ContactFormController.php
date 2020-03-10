<?php

namespace App\Http\Controllers;


use App\Mail\ContactFormMail;
use App\Models\User;
use App\Rules\Captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Auth;
use Session;

class ContactFormController extends Controller
{
##################################################################################################################
#  ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗
# ██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝
# ██║     ██████╔╝█████╗  ███████║   ██║   █████╗  
# ██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝  
# ╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗
#  ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
// Show the form for creating a new resource
##################################################################################################################
   public function create()
   {
      return view('contactForm.create');
   }


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗  
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
// Store a newly created resource in storage
##################################################################################################################
   public function store(Request $request)
   {

      $data = request()->validate([
         'email' => 'required|email',
         'subject' => 'required',
         'message' => 'required',
         // 'g-recaptcha-response' => new Captcha(),
      ]);

      // From : https://itnext.io/stopping-form-spam-in-laravel-76760bf84bd
      if ($request->faxonly) {
         // dd($request->faxonly);
         return redirect()->back()->withSuccess('Your form has been submitted'); 
      }
      // From : https://itnext.io/stopping-form-spam-in-laravel-76760bf84bd

      // Send email
      Mail::to('stephaneandstacie@gmail.com')->send(new ContactFormMail($data));

      return view('contactForm.thankyou');
   }

}
