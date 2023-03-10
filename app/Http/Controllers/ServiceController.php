<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ServiceController extends Controller
{
    public function new(Request $request){
        return view('service.new');
    }

    public function create(Request $request):RedirectResponse{

        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = Storage::disk('public')->put('services/images', $image);
        }else{
            $image = new File('/home/medusa/Downloads/no-image.jpg');
            $path = Storage::disk('public')->put('services/images', $image);
        }

        $service = Service::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$path,
            'user_id'=>Auth::id()
        ]);
        return redirect('/dashboard')->with('status', 'Service created!');
    }

    public function findByUser(){

        $id = Auth::id();

        $services = Service::where('user_id',$id)->get();
       
        $data['services'] = $services;

        return view('service.my-services',$data);
    }

    public function show($id){

        $service = Service::find($id);
       
        $data['service'] = $service;

        return view('service.show', $data);
    }
}
