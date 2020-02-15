<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests;
use Illuminate\Http\Request;
use Mail;
use Session;
use App\Mail\SendEmail;

class MailController extends Controller
{
   
	public function home(){
		return view("admin.mail.home");
	}

	public function sendemail(Request $get){
		$this->validate($get,[
          "email" => "required",
           "subject" => "required",
          "message" => "required",
		]);
		$email = $get->email;
		$subject = $get->subject;
		$message = $get->message;

	   	Mail::to($email)->send( new SendEmail($subject, $message) );
       //  Session::flash("success");
		 return redirect('/')->with('flash_message_success','Message was sent Successfully!');

	}
	
}
