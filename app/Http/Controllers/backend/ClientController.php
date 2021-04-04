<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Client;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    public function clients_list(){
    $all_client = Client::latest()->orderBy('clients.id', 'desc')->get();
	return view('backend.client.client_list',compact('all_client'));
    }
    public function add_client(){
    	return view('backend.client.add_client');

    }
   public function client_action(Request $request){
   $inputs = $request->except('_token');
   $rules=[
               'name'=>'required',
               'email'=>'required|email',
               'description'=>'required',
        ];

    $validation = Validator::make($inputs, $rules);
        if ($validation->fails())
        {
         return redirect()->back()->withErrors($validation)->withInput();

        }else{

            $image = $request->file('client_image');
            $slug =  Str::slug($request->input('name'));
            if (isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('admin_media/images/client'))
                {
                    Storage::disk('public')->makeDirectory('admin_media/images/client');
                }
                $postImage = Image::make($image)->resize(115, 115)->stream();
                    Storage::disk('public')->put('admin_media/images/client/'.$imageName, $postImage);
            } else
            {
                $imageName = 'user.png';

            }
            $client = new Client();
            $client->name=$request->input('name');
            $client->email=$request->input('email');
            $client->description=$request->input('description');
            $client->image=$imageName;
             if ($client->save()) {
             $request->session()->flash('success', 'Client Successfully Created !!');
             }else{
              $request->session()->flash('error', 'Something Went Wrong !!');
             }
            return redirect('/add_client');

        }//end else

   }

public function delete_client(Request $request,$client_id){
 $client = Client::where('id', $client_id)->delete();
 $request->session()->flash('success', 'Client Successfully Deleted !!');
  return redirect('/clients_list');
}

public function edit_view_client($client_id){
$client = Client::latest()->where('id', $client_id)->first();
return view('backend.client.edit_view_client',compact('client'));

}

public function update_action(Request $request){
$inputs = $request->except('_token');
$id=$request->input('client_id');
$rules=[
               'name'=>'required',
               'email'=>'required|email',
               'description'=>'required',
        ];

   $validation = Validator::make($inputs, $rules);
    if ($validation->fails())
    {
        return redirect()->back()->withErrors($validation)->withInput();

    }else{
            $image = $request->file('client_image');
            $slug =  Str::slug($request->input('name'));
            $client =  Client::find($id);

            if (isset($image))
            {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('admin_media/images/client'))
                {
                    Storage::disk('public')->makeDirectory('admin_media/images/client');
                }

                if (Storage::disk('public')->exists('admin_media/images/client/'.$client->image))
                {
                    Storage::disk('public')->delete('admin_media/images/client/'.$client->image);
                }

                $postImage = Image::make($image)->resize(115, 115)->stream();
                    Storage::disk('public')->put('admin_media/images/client/'.$imageName, $postImage);
                } else
                {
                    $imageName = $client->image;
                }

            $client->name=$request->input('name');
            $client->email=$request->input('email');
            $client->description=$request->input('description');
            $client->image=$imageName;

                if ($client->save()) {
                 $request->session()->flash('success', 'Client Successfully Updated !!');
                  return redirect('/clients_list');
                 }else{
                  $request->session()->flash('error', 'Something Went Wrong !!');
                  redirect($_SERVER['HTTP_REFERER']);

             }

        }
}


public function view_client($client_id){
$client = Client::latest()->where('id', $client_id)->first();
return view('backend.client.view_client',compact('client'));

}


}
