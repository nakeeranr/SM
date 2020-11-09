<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->tinyInteger('status')->unsigned()->comment('0:Inactive, 1:Active');
            $table->softDeletes();
            $table->timestamps();
        });

        $classNames = config('constants.CLASSES');

        foreach ($classNames as $name) {
            DB::table('classes')->insert([
                'name' => $name,
                'status' => '1',
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
