<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Lead;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class TelecallerController extends Controller
{
    public function __construct()
    {
         $this->middleware('telecaller_auth');

    }

    public  function index(){

        return view('backend.telecaller.tele_dashboard');
     }


    public  function profile_telecaller(){

        return view('backend.telecaller.profile');

    }

    public function change_password_telecaller(){

        return view('backend.telecaller.change_password');
    }

    public function change_password_tel(){
        return view('backend.admin.user.admin_change_password');
       }

    public function changePasswordactiontele(Request $request){
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
            return redirect('/change_password_telecaller');
            }else{
            $user=User::find($user_id);
            $user->password=Hash::make($newPass);
            if($user->save()){
                $request->session()->flash('success', 'Your password changed successfully  !!');
            return redirect('/change_password_telecaller');
            }else{
                $request->session()->flash('error', 'Something Went Wrong !!');
            return redirect('/change_password_telecaller');
            }

           }
        }
      }

    public function leads_list(){
        return view('backend.telecaller.leads_list');
    }
    public function add_lead(){
        $sales=User::select('id','name')->where('role','Sales')->get();
        return view('backend.telecaller.add_lead',compact('sales'));
    }

    public function add_lead_action(Request $request){
        $inputs = $request->except('_token');
        $rules=[
            'purpose_of_loan'=>'required',
            'full_name'  => 'required',
            'mobile_number'  => 'required',
            'company_name'  => 'required',
            'disignation'=>'required',
            'lead_allote' => 'required'
        ];

       $validation = Validator::make($inputs, $rules);
       if($validation->fails())
       {
       return redirect()->back()->withErrors($validation)->withInput();

       }else{

        try{
            $lead = new Lead;
            $lead->purpose_of_loan = $request->purpose_of_loan;
            $lead->full_name = $request->full_name;
            $lead->mobile_number = $request->mobile_number;
            $lead->email = $request->email;
            $lead->date_of_birth = $request->date_of_birth;
            $lead->pan_no = $request->pan_no;
            $lead->mother_name = $request->mother_name;
            $lead->spouse_details = $request->spouse_details;
            $lead->spouse_dob = $request->spouse_dob;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->full_name = $request->full_name;
            $lead->save();
            $request->session()->flash('success', 'Your lead generated successfully  !!');
            return redirect('/leads_list');
        }
        catch(Exception $e){
            $request->session()->flash('error', 'operation failed  !!');
            return redirect('/add_lead');
        }

       }

    }



}
