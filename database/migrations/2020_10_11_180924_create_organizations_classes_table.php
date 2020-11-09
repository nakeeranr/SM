<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations_classes', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('classes_id');

             //FOREIGN KEY CONSTRAINTS
            $table->foreign('organization_id')->references('id')->on('Organizations');
            $table->foreign('classes_id')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations_classes');
    }
}
