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
	
	public function show($id){
		$message = Message::findOrFail($id);
			
		return $message;
	}
	
	public function store(Request $request){
		
		// validate our input 
		$this->validate($request, [	'name' => 'required|max:255' ]);
		$this->validate($request, [	'email' => 'required | email' ]);
		$this->validate($request, [	'text' => 'required' ]);

		
		// we have a hamburger with a valid name
		$ip = $_SERVER['REMOTE_ADDR'];
		$browser = $_SERVER['HTTP_USER_AGENT'];
		//$browser = get_browser();
		$message = Message::create([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'link' => $request->input('link'),
			'text' => $request->input('text'),
			'ip' => $ip,
			'browser_info' => $browser
		]);
			
		return $message;
	}
	
	public function update(Request $request, $id ){
		
		$message = Message::findOrFail($id);
		
			// validate our input burger
			$this->validate($request, [	'name' => 'required|max:255' ]);
			$this->validate($request, [	'text' => 'required' ]);
			$this->validate($request, [	'email' => 'required' ]);
		
			$message->update([
				'name' => $request->input('name'),
				'email' => $request->input('email'),
				'text' => $request->input('text'),
				'link' => $request->input('link')
			]);
			return $message;
		
	}
}
