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

            // name
            $table->text('name');
            
            // phone
            $table->text('phone')->nullable();
            
            // address
            $table->text('address')->nullable();
            
            // person_name
            $table->text('person_name')->nullable();
            
            // person_phone
            $table->text('person_phone')->nullable();
            
            // note
            $table->text('note')->nullable();

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
