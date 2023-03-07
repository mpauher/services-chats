<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index(Request $request){

        $services = Service::all();

        foreach($services as $service){

            //Return the chat_id if exists or asign chat_id=0
            $chat = Chat::where('service_id', $service->id)->where('guest_user_id', Auth::user()->id)->first();
            $service->chat_id=($chat) ? $chat->id : 0; 

            //Validate the service's owner
            if($service->user_id == Auth::user()->id){
                $service->type_user = "owner";
            } else{
                $service->type_user = "guest";
            }
        }

        $data['services'] = $services;

        return view('dashboard',$data);
    }
    
}
