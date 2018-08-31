<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Message;

class MessageController extends Controller
{
    public function index(Request $request){

        $propertyName = $request->input('sort');
        $order = $request->input('order');
		return Message::orderBy($propertyName, $order)->paginate(10);
	}
		
	public function store(Request $request)
    {
		$this->validate($request, [	'name' => 'required|max:255' ]);
		$this->validate($request, [	'email' => 'required | email' ]);
		$this->validate($request, [	'text' => 'required' ]);
        //$this->validate($request, [	'link' => 'url' ]);
		
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
		        /*$link = $request->input('link');
                if (strpos($request->input('link'), 'http') == false) {
                    $link = "http://www." . $request->input('link');
                }*/
                    $message = Message::create([
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'link' => $request->input('link'),
                        'text' => $request->input('text'),
                        'ip' => $ip,
                        'browser_info' => $browser
                    ]);
		    }
			
		return $message;
	}
	
	
}
