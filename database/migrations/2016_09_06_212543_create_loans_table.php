<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{

    public function up()
    {
      Schema::create('loan_states', function(Blueprint $table) {

          $table->bigIncrements('id');
          $table->string('name');
          $table->timestamps();
      });

      Schema::create('flow_states', function(Blueprint $table) {

          $table->bigIncrements('id');
          $table->string('name');
          $table->timestamps();
      });

      Schema::create('credit_destination', function(Blueprint $table) {

          $table->bigIncrements('id');
          $table->string('name');
          $table->timestamps();
      });

      Schema::create('loan_types', function(Blueprint $table) {

          $table->bigIncrements('id');
          $table->string('name');
          $table->timestamps();
      });

    }


    public function down()
    {
      Schema::drop('state_loans');
      Schema::drop('state_flows');
      Schema::drop('credit_destination');
      Schema::drop('loan_types');
    }


}
