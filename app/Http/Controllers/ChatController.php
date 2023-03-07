<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show($service_id,$id){

        if($id){
            $chat = Chat::find($id);
            $chat->id = $id;
        }else{
            $chat = Chat::create([
                'service_id' => $service_id,
                'guest_user_id' => Auth::user()->id,
            ]);
        }

        $data['messages'] = Message::where('chat_id',$id)->get();

        return view('chat.show',$data);
    }

    public function create(Request $request):RedirectResponse{

        $service_id = $id;

        $service = Service::create([
            'service_id'=>$service_id
        ]);
        return redirect('/chat')->with('status', 'Chat created!');
    }
}
