<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('phone_number', 16)->nullable();
            $table->date('dob')->nullable();
            $table->tinyInteger('gender')->nullable()->comment("0 = Male, 1 = Female, 2 = Other");
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
        Schema::dropIfExists('admin_users');
    }
}
