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
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

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

        $messages = Message::where('chat_id', $id)->latest()->take(30)->get()->sortBy('created_at');

        // $service = Service::where('id', $service_id)->first();

        // if($service->user_id == Auth::user()->id){
                    
        // }

        // dd($service);

        // dd($messages);

        if(count($messages) > 0){
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
            'text'=>'nullable|string',
        ]);

        $path = '';

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = Storage::disk('public')->put('chats/files', $file);
        }
        
        $message = Message::create([
            'date'=>Carbon::now(),
            'text'=>$request->text,
            'file'=>$path,
            'chat_id'=>$chat_id,
            'user_id'=>Auth::user()->id
        ]);

        return redirect()->route('chat.show', ['service_id' => $service_id, 'id' => $chat_id]);
    }

    public function findByUser(){

        //Find chats where user is the owner 
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

        //Find chats where the user is a guest
        $guest_chats = Service::join('chats', 'services.id', '=', 'chats.service_id')
        ->join('users', 'users.id', '=', 'services.user_id')
        ->where('chats.guest_user_id', '=', Auth::user()->id)
        ->select(
            'chats.id as chat_id',
            'chats.created_at as created_at',
            'services.id as service_id',
            'services.title as service_title',
            'users.id as guest_user_id',
            'users.name as guest_user_name'
            )
        ->get();  

        $data['guest_chats'] = $guest_chats;
        $data['chats'] = $chats;

        return view('chat.my-chats',$data);
    }
}
