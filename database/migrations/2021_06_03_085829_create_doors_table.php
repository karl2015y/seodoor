<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doors', function (Blueprint $table) {
            $table->id();

            // vendor_id
            $table->foreignId('vendor_id')->references('id')->on('vendors');;	

            // name
            $table->text('name');
            
            // URL
            $table->text('URL');
            
            // pic
            $table->text('pic');
            
            // pic_name
            $table->text('pic_name');
            
            // title
            $table->text('title');
            
            // content
            $table->text('content');
            
            // to_link
            $table->text('to_link');
            
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
        Schema::dropIfExists('doors');
    }
}
