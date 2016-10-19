<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEconomicComplementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economic_complement_types', function(Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();

        });

        Schema::create('economic_complement_modalities', function(Blueprint $table) {

            $table->bigIncrements('id');
            $table->UnsignedBigInteger('economic_complement_type_id');
            $table->string('name');
            $table->string('description');
            $table->string('shortened');
            $table->timestamps();
            $table->foreign('economic_complement_type_id')->references('id')->on('economic_complement_types');

        });

        Schema::create('economic_complements', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->UnsignedBigInteger('affiliate_id');
            $table->UnsignedBigInteger('economic_complement_modality_id')->nullable();
            $table->UnsignedBigInteger('city_id')->nullable();
            $table->string('code')->unique()->required();
            $table->date('reception_date')->nullable();
            $table->date('review_date')->nullable();

            // $table->decimal('total_quotable', 13, 2);
            // $table->decimal('total_additional_quotable', 13, 2);
            // $table->decimal('subtotal', 13, 2);
            // $table->decimal('performance', 13, 2);
            // $table->decimal('total', 13, 2);
            // $table->string('comment');

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('affiliate_id')->references('id')->on('affiliates')->onDelete('cascade');
            $table->foreign('economic_complement_modality_id')->references('id')->on('economic_complement_modalities');
            $table->foreign('city_id')->references('id')->on('cities');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('economic_complements');
    }
}
