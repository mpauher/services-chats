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
            $chat = Chat::where('service_id', $service->id)->where('guest_user_id', Auth::user()->id)->first();
            $service->chat_id=($chat) ? $chat->id : 0;            
        }

        $data['services'] = $services;

        return view('dashboard',$data);
    }
    
}
