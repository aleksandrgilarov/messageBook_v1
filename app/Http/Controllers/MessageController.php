<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Message;
use App\Image;
use DB;

class MessageController extends Controller
{
    public function index(Request $request){

        $propertyName = $request->input('sort');
        $order = $request->input('order');
		return Message::orderBy($propertyName, $order)->with('images')->paginate(10);
	}
		
	public function store(Request $request)
    {
		$this->validate($request, [	'name' => 'required|max:255' ]);
		$this->validate($request, [	'email' => 'required | email' ]);
		$this->validate($request, [	'text' => 'required' ]);
        $this->validate($request, [	'msgLink' => 'url' ]);

		$ip = request()->ip();
		$browser = $_SERVER['HTTP_USER_AGENT'];

        $path = $request->file('file');

        if ($request->input('msgLink') != null)
            $link = $request->input('msgLink');
        else
            $link = null;
        $message = Message::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'link' => $link,
            'text' => $request->input('text'),
            'image_url' => $path,
            'ip' => $ip,
            'browser_info' => $browser
        ]);

		return $message;
	}

	public function uploadPic (Request $request)
    {
        $path = $request->file('file')->store('public');
        $path = substr($path, 7);
        $id = DB::table('messages')->orderBy('created_at', 'desc')->first();
        $msg_id = $id->id;
        $image = Image::create([
            'path' => $path,
            'message_id' => $msg_id
        ]);
        return $image;
    }
}
