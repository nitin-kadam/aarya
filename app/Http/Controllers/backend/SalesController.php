<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\User;
use App\Lead;
use App\BranchAddress;

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
        $user_id=Auth::user()->id;
        $leads=Lead::OrderBy('id','DESC')->where('lead_allocate',$user_id)->get()->count();
        $todayLeads=Lead::OrderBy('id','DESC')->where('lead_allocate',$user_id)->whereDate('created_at', Carbon::today())->get()->count();
        return view('backend.sales.sales_dashboard',compact('leads','todayLeads'));
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

    public function get_sales_branches_sales(Request $request,$id){
        $sales = User::where("branch_id",$id)->get();
        return json_encode($sales);
    }
      public function leads_list(){
        $user_id=Auth::user()->id;
        $leads=Lead::OrderBy('id','DESC')->where('lead_allocate',$user_id)->get();
        return view('backend.sales.leads_list',compact('leads'));
    }
    public function add_lead(){
        $branches = BranchAddress::orderBy('id', 'desc')->get();
        // $sales=User::select('id','name')->where('role','Sales')->get();
        return view('backend.sales.add_lead',compact('sales','branches'));
    }
    public function delete_lead_sales(Request $request,$lead_id){
        $user = Lead::where('id', $lead_id)->delete();
        if ($user) {
         $request->session()->flash('success', 'Lead Successfully Deleted !!');
         }else{
          $request->session()->flash('error', 'Something Went Wrong !!');
         }
        return redirect('/leads_list_seals');
      }

    public function add_lead_action_sales(Request $request){
        $inputs = $request->except('_token');
        $rules=[
            'purpose_of_loan'=>'required',
            'full_name'  => 'required',
            'mobile_number'  => 'required',
            'company_name'  => 'required',
            'disignation'=>'required',
            'branch_allote' => 'required',
            'lead_allote' => 'required'
        ];

       $validation = Validator::make($inputs, $rules);
       if($validation->fails())
       {
       return redirect()->back()->withErrors($validation)->withInput();

       }else{

        try{
            $user_id=Auth::user()->id;
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
            $lead->res_address = $request->res_address;
            $lead->pincode = $request->pincode;
            $lead->state = $request->state;
            $lead->city = $request->city;
            $lead->landmark = $request->landmark;
            $lead->per_address = $request->per_address;
            $lead->per_state = $request->per_state;
            $lead->per_city = $request->per_city;
            $lead->per_landmark = $request->per_landmark;
            $lead->company_name = $request->company_name;
            $lead->disignation = $request->disignation;
            $lead->gross_salary = $request->gross_salary;
            $lead->net_salary = $request->net_salary;
            $lead->deduction_gpf = $request->deduction_gpf;
            $lead->deduction_soc_emi = $request->deduction_soc_emi;
            $lead->deduction_other = $request->deduction_other;
            $lead->already_active_loan = $request->already_active_loan;
            $lead->ref_name = $request->ref_name;
            $lead->ref_mobile = $request->ref_mobile;
            $lead->ref_pincode = $request->ref_pincode;
            $lead->ref_address = $request->ref_address;
            $lead->ref_name_one = $request->ref_name_one;
            $lead->ref_mobile_one = $request->ref_mobile_one;
            $lead->ref_pincode_one = $request->ref_pincode_one;
            $lead->ref_address_one = $request->ref_address_one;
            $lead->senior_name = $request->senior_name;
            $lead->senior_mobile = $request->senior_mobile;
            $lead->senior_designation = $request->senior_designation;
            $lead->client_type = $request->client_type;
            $lead->req_loan_amt = $request->req_loan_amt;
            $lead->branch_allocate = $request->branch_allote;
            $lead->lead_allocate = $request->lead_allote;
            $lead->narration = $request->narration;
            $lead->cibil_score = $request->cibil_score;
            $lead->who_added = $user_id;
            $lead->save();
            $request->session()->flash('success', 'Your lead generated successfully  !!');
            return redirect('/leads_list_seals');
        }
        catch(Exception $e){
            $request->session()->flash('error', 'operation failed  !!');
            return redirect('/add_lead');
        }

       }

    }


    public function edit_view_lead(Request $request,$lead_id){
        $lead = Lead::where('id', $lead_id)->first();
        $lead->load('get_allocated');
        $lead->load('get_added');
        // return $lead;
        $branches = BranchAddress::orderBy('id', 'desc')->get();
        return view('backend.sales.edit_view_lead',compact('lead','branches'));
      }
      public function updated_lead_action(Request $request){
        $inputs = $request->except('_token');
        $rules=[
            'purpose_of_loan'=>'required',
            'full_name'  => 'required',
            'mobile_number'  => 'required',
            'company_name'  => 'required',
            'disignation'=>'required',
            'branch_allote' => 'required',
            'lead_allote' => 'required'
        ];

       $validation = Validator::make($inputs, $rules);
       if($validation->fails())
       {
       return redirect()->back()->withErrors($validation)->withInput();

       }else{

        try{
            $user_id=Auth::user()->id;
            $lead_id=$request->lead_id;
            $lead =Lead::find($lead_id);
            $lead->purpose_of_loan = $request->purpose_of_loan;
            $lead->full_name = $request->full_name;
            $lead->mobile_number = $request->mobile_number;
            $lead->email = $request->email;
            $lead->date_of_birth = $request->date_of_birth;
            $lead->pan_no = $request->pan_no;
            $lead->mother_name = $request->mother_name;
            $lead->spouse_details = $request->spouse_details;
            $lead->spouse_dob = $request->spouse_dob;
            $lead->res_address = $request->res_address;
            $lead->pincode = $request->pincode;
            $lead->state = $request->state;
            $lead->city = $request->city;
            $lead->landmark = $request->landmark;
            $lead->per_address = $request->per_address;
            $lead->per_state = $request->per_state;
            $lead->per_city = $request->per_city;
            $lead->per_landmark = $request->per_landmark;
            $lead->company_name = $request->company_name;
            $lead->disignation = $request->disignation;
            $lead->gross_salary = $request->gross_salary;
            $lead->net_salary = $request->net_salary;
            $lead->deduction_gpf = $request->deduction_gpf;
            $lead->deduction_soc_emi = $request->deduction_soc_emi;
            $lead->deduction_other = $request->deduction_other;
            $lead->already_active_loan = $request->already_active_loan;
            $lead->ref_name = $request->ref_name;
            $lead->ref_mobile = $request->ref_mobile;
            $lead->ref_pincode = $request->ref_pincode;
            $lead->ref_address = $request->ref_address;
            $lead->ref_name_one = $request->ref_name_one;
            $lead->ref_mobile_one = $request->ref_mobile_one;
            $lead->ref_pincode_one = $request->ref_pincode_one;
            $lead->ref_address_one = $request->ref_address_one;
            $lead->senior_name = $request->senior_name;
            $lead->senior_mobile = $request->senior_mobile;
            $lead->senior_designation = $request->senior_designation;
            $lead->client_type = $request->client_type;
            $lead->req_loan_amt = $request->req_loan_amt;
            $lead->branch_allocate = $request->branch_allote;
            $lead->lead_allocate = $request->lead_allote;
            $lead->narration = $request->narration;
            $lead->cibil_score = $request->cibil_score;
            $lead->who_added = $user_id;
            $lead->save();
            $request->session()->flash('success', ' lead updated successfully  !!');
            return redirect('/leads_list_seals');
        }
        catch(Exception $e){
            $request->session()->flash('error', 'operation failed  !!');
            return redirect()->back();
        }

       }

    }

}
