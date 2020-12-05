<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')->references('id')->on('Organizations');

            //personal information
            $table->string('first_name');
            $table->string('last_name')->nullable();
           
            $table->string('phone_number', 16)->nullable();
            $table->date('dob')->nullable();
            $table->string('emailID')->nullable();
            $table->tinyInteger('gender')->nullable()->comment("0 = Male, 1 = Female, 2 = Other");
            $table->string('profilePic')->nullable();

            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pin_code')->nullable();

            //Eductional details
            $table->string('qualification')->nullable();
            $table->string('experience_details')->nullable();
            $table->string('certification')->nullable();
            $table->string('subject')->nullable();

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
        Schema::dropIfExists('teachers');
    }
}
