<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            // plan_id
            $table->foreignId('user_id')->references('id')->on('users');;	

            // name
$table->text('name');
            
            // phone
$table->text('phone');
            
            // address
$table->text('address');
            
            // person_name
$table->text('person_name');
            
            // person_phone
            $table->text('person_phone');
            
            // note
            $table->text('note');

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
        Schema::dropIfExists('vendors');
    }
}
