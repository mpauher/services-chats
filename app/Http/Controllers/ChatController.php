<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function show($service_id,$id){

        if($id){
            $chat = Chat::find($id);
            $chat->service_id = $service_id;
            $chat->id = $id;
        }else{
            $chat = Chat::create([
                'service_id' => $service_id,
                'guest_user_id' => Auth::user()->id,
            ]);
        }

        $data['messages'] = Message::where('chat_id',$id)->get();
        $data['service_id'] = $service_id;
        $data['chat_id'] = $id;

        return view('chat.show',$data);
    }

    // public function create(Request $request):RedirectResponse{

    //     $service_id = $id;

    //     $service = Service::create([
    //         'service_id'=>$service_id
    //     ]);
    //     return redirect('/chat')->with('status', 'Chat created!');
    // }

    public function send(Request $request,$service_id,$id){

        $chat_id = $id;

        $request->validate([
            'text'=>'required|string',
        ]);
        
        $message = Message::create([
            'date'=>Carbon::now(),
            'text'=>$request->text,
            'chat_id'=>$chat_id,
            'user_id'=>Auth::user()->id
        ]);

        return redirect()->route('chat.show', ['service_id' => $service_id, 'id' => $chat_id]);}
}
