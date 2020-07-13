<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->date('dob')->nullable();
            $table->bigInteger('age')->nullable();
            // $table->string('cnic')->unique();
            $table->string('phone_no')->unique();
            // $table->string('na_no')->nullable();
            $table->string('education')->nullable();
            $table->text('political_profile')->nullable();
            $table->string('picture')->nullable();
            $table->string('fb_link')->nullable();
            $table->unsignedBigInteger('committee_id');
            $table->foreign('committee_id')->references('id')->on('committees');
            // $table->text('address')->nullable();
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
        Schema::dropIfExists('people');
    }
}
