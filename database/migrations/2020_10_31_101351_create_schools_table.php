<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('user_name')->nullable();
            $table->date('dob')->nullable();

            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('classes');

            $table->unsignedBigInteger('section_id');
            // $table->foreign('class_id')->references('id')->on('classes');

            $table->tinyInteger('gender')->nullable()->comment("0 = Male, 1 = Female, 2 = Other");
            $table->tinyInteger('status')->unsigned()->comment('0:Inactive, 1:Active');
            $table->string('primary_contact', 16);
            $table->string('secondary_contact', 16)->nullable();
            $table->string('primay_email');
            $table->string('secondary_email')->nullable();
            $table->string('profilePic')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('pin_code')->nullable();

            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            
            $table->softDeletes();
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
        Schema::dropIfExists('schools');
    }
}
