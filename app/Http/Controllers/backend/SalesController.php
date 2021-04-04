<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SalesController extends Controller
{
    //
    public function __construct()
    {
         $this->middleware('sales_auth');

    }


    public  function index(){
     return view('backend.sales.sales_dashboard');
     }

     public  function profile_sales(){

        return view('backend.sales.profile');

    }

    public function change_password_sales(){

        return view('backend.sales.change_password');
    }

    public function changePasswordactionSales(Request $request){
        $inputs = $request->except('_token');
        $rules=[
          'new_password'     => 'required|min:6',
          'con_password' => 'required|same:new_password'

      ];
      $validation = Validator::make($inputs, $rules);
      if($validation->fails())
      {
      return redirect()->back()->withErrors($validation)->withInput();

      }else{
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)->first();
        // return $user;
        $oldPass=Hash::make($request->input('old_password'));
        $newPass=$request->input('new_password');
        $conPass=$request->input('con_password');
            if($newPass != $conPass){
            $request->session()->flash('error', 'Your new password and confirm password did not match !!');
            return redirect('/change_password_sales');
            }else{
            $user=User::find($user_id);
            $user->password=Hash::make($newPass);
            if($user->save()){
                $request->session()->flash('success', 'Your password changed successfully  !!');
            return redirect('/change_password_sales');
            }else{
                $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect('/change_password_sales');
            }

           }
        }
      }

}
