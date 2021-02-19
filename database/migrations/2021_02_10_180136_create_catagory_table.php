<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatagoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catagory', function (Blueprint $table) {
            $table->id();
            $table->string('catagory_name');
            $table->string('catagory_slug');
            $table->string('catagory_image');
            $table->text('catagory_desc');
            $table->integer('catagory_parent_id')->default(0);
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
        Schema::dropIfExists('catagory');
    }
}
