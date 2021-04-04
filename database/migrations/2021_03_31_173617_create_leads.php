<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('purpose_of_loan', ['PL', 'BL','HL','LAP','CAR LOAN','CREDIT CARD'])->nullable();
            $table->string('full_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_details')->nullable();
            $table->date('spouse_dob')->nullable();
            $table->string('res_address')->nullable();
            $table->string('landmark')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('per_address')->nullable();
            $table->string('per_landmark')->nullable();
            $table->string('per_city')->nullable();
            $table->string('company_name')->nullable();
            $table->string('disignation')->nullable();
            $table->string('gross_salary')->nullable();
            $table->enum('deduction', ['GPF', 'SOC LOAN EMI','OTHER']);
            $table->string('net_salary')->nullable();
            $table->enum('already_active_loan', ['HL EMI','PL EMI','OTHER EMI']);
            $table->string('ref_name')->nullable();
            $table->string('ref_address')->nullable();
            $table->string('ref_mobile')->nullable();
            $table->string('ref_pincode')->nullable();
            $table->string('senior_name')->nullable();
            $table->string('senior_mobile')->nullable();
            $table->string('senior_designation')->nullable();
            $table->integer('lead_allote')->nullable();
            $table->text('narration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
