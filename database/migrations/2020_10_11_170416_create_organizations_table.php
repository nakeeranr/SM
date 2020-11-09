<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('org_code', 64)->unique()->nullable();
            $table->string('name');

            $table->string('primary_contact', 16)->nullable();
            $table->string('secondary_contact', 16)->nullable();

            $table->string('website_url')->nullable();
            $table->unsignedBigInteger('curriculum')->nullable();
            
            $table->string('email')->nullable();
            $table->mediumText('description')->nullable();

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
            
            $table->softDeletes();
            $table->timestamps();
           
        });

        //Trigger
        $prefix = config('constants.CODE_PREFIX.Organization');
            DB::unprepared('
                  CREATE DEFINER = CURRENT_USER TRIGGER `unique_Organization_codes_after_insert` 
                  BEFORE INSERT ON `organizations`
                  FOR EACH ROW 
                  BEGIN 
                    declare ready int default 0; 
                    declare rnd_str text;
                    if (new.org_code is null or new.org_code = "") then
                       while not ready do 
                        set rnd_str := concat("'.$prefix.'",lpad(conv(floor(rand()*pow(36,6)), 10, 36), 7, 0)); 
                        if not exists (select * from organizations where org_code = rnd_str) then 
                          set new.org_code = rnd_str; 
                          set ready := 1; 
                        end if; 
                       end while; 
                    end if;
                  END
          ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Organizations');
        DB::unprepared('DROP TRIGGER IF EXISTS `unique_Organization_codes_after_insert`');
    }
}
