<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Message;

class MessageController extends Controller
{
    public function index(){
		return Message::orderBy('created_at','desc')->paginate(10);
	}
		
	public function store(Request $request){
		
		// validate our input 
		$this->validate($request, [	'name' => 'required|max:255' ]);
		$this->validate($request, [	'email' => 'required | email' ]);
		$this->validate($request, [	'text' => 'required' ]);

		
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$browser = $_SERVER['HTTP_USER_AGENT'];
		
		if ($request->input('link') == '') {
			$message = Message::create([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'text' => $request->input('text'),
			'ip' => $ip,
			'browser_info' => $browser
		]);
		}else{
		$message = Message::create([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'link' => $request->input('link'),
			'text' => $request->input('text'),
			'ip' => $ip,
			'browser_info' => $browser
		]);}
			
		return $message;
	}
	
	
}
