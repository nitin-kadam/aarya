<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{

    //
    protected $fillable = [
        'purpose_of_loan', 'full_name', 'mobile_number','email','date_of_birth','pan_no','mother_name','spouse_details',
        'spouse_dob','res_address','landmark','city','pincode','per_address','per_landmark','per_city','company_name','disignation',
        'gross_salary','deduction','net_salary','already_active_loan','ref_name','ref_address','ref_mobile','ref_pincode',
        'senior_name','senior_mobile','senior_designation','lead_allote','narration'
    ];


}
