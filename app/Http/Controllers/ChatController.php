<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function show($service_id,$id){

        if($id){
            $chat = Chat::find($id);
            $chat->service_id = $service_id;
            $chat->id = $id;
        }else if($id==0){
            $chat = Chat::create([
                'service_id' => $service_id,
                'guest_user_id' => Auth::user()->id,
            ]);
            $id= $chat->id;
        }

        $messages = Message::where('chat_id',$id)->get();

        if(count($messages)>0){
            foreach($messages as $message){
                $message->date_for_humans = $message->created_at->diffForHumans();
            }
        }

        $data['messages'] = $messages;
        $data['service_id'] = $service_id;
        $data['chat_id'] = $id;

        return view('chat.show',$data);
    }

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

        return redirect()->route('chat.show', ['service_id' => $service_id, 'id' => $chat_id]);
        // dd($chats[0]->created_at->diffForHumans());
    }

    public function findByUser(){

        $chats = Service::join('chats', 'services.id', '=', 'chats.service_id')
        ->join('users', 'users.id', '=', 'chats.guest_user_id')
        ->where('services.user_id', '=', Auth::user()->id)
        ->select(
            'chats.id as chat_id',
            'chats.created_at as created_at',
            'services.id as service_id',
            'services.title as service_title',
            'users.id as guest_user_id',
            'users.name as guest_user_name'
            )
        ->get();        

        // foreach($chats as $chat){
        //     $chat->guest_user = User::where('id',$chat->guest_user_id)->pluck('name')->first();
        // }

        // $data['services'] = $services;
        $data['chats'] = $chats;
        // dd($chats);

        return view('chat.my-chats',$data);
    }
}
