<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{

    protected $fillable = [
        'purpose_of_loan', 'full_name', 'mobile_number', 'email', 'date_of_birth', 'pan_no', 'mother_name', 'spouse_details', 'spouse_dob',
        'res_address', 'landmark', 'city', 'pincode', 'per_address', 'per_landmark', 'per_city', 'company_name', 'disignation', 'gross_salary', 'deduction_gpf', 'deduction_soc_emi', 'deduction_other', 'net_salary',
        'already_active_loan', 'ref_name', 'ref_address', 'ref_mobile','ref_pincode', 'ref_name_one', 'ref_address_one', 'ref_mobile_one',
        'ref_pincode_one', 'senior_name', 'senior_mobile', 'senior_designation', 'lead_allote', 'cibil_score', 'pdf'
    ];


}
