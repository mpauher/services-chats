<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index(Request $request){
        $data['services'] = Service::all();

        return view('dashboard',$data);
    }

    public function new(Request $request){
        return view('service.new');
    }

    public function create(Request $request):RedirectResponse{

        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'image'=>'required|string',
        ]);

        $service = Service::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$request->image,
            'user_id'=>Auth::id()
        ]);
        return redirect('/dashboard')->with('status', 'Service created!');
    }
}
