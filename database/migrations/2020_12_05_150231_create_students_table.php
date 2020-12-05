<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('reg_no', 64)->unique()->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('Organizations');

            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections');

            $table->string('joining_date')->nullable();
            $table->string('leaving_date')->nullable();

            $table->string('first_name');
            $table->string('last_name')->nullable();
           
            $table->date('dob')->nullable();
            $table->tinyInteger('gender')->nullable()->comment("0 = Male, 1 = Female, 2 = Other");
            $table->string('profilePic')->nullable();
            $table->string('blood_group')->nullable();

            $table->string('primary_contact_no', 16)->nullable();
            $table->string('secondary_contact_no', 16)->nullable();

            $table->string('primary_emailID', 16)->nullable();
            $table->string('secondary_emailID', 16)->nullable();

            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pin_code')->nullable();

            $table->tinyInteger('status')->unsigned()->comment('0:Inactive, 1:Active');

            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');

            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
