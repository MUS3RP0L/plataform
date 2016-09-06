<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{

    public function up()
    {
      Schema::create('collection_types', function(Blueprint $table) {

          $table->bigIncrements('id');
          $table->string('name');
          $table->timestamps();
      });
    }


    public function down()
    {
        Schema::drop('collection_types');
    }

}
