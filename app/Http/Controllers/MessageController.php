<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Message;

class MessageController extends Controller
{
    public function index(){
		return Message::orderBy('created_at', 'desc')->paginate(10);
	}
		
	public function store(Request $request)
    {
		$this->validate($request, [	'name' => 'required|max:255' ]);
		$this->validate($request, [	'email' => 'required | email' ]);
		$this->validate($request, [	'text' => 'required' ]);
		
		$ip = request()->ip();
		$browser = $_SERVER['HTTP_USER_AGENT'];
		
		if ($request->input('link') == '') {
			$message = Message::create([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'text' => $request->input('text'),
			'ip' => $ip,
			'browser_info' => $browser
		]);
		}
		else
		    {
		        $link = $request->input('link');
                if (strpos($request->input('link'), 'www') == false) {
                    $link = "http://www." . $request->input('link');
                }//http://www.
                    $message = Message::create([
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'link' => $link,
                        'text' => $request->input('text'),
                        'ip' => $ip,
                        'browser_info' => $browser
                    ]);
		    }
			
		return $message;
	}
	
	
}
