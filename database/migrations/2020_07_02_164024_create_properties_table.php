<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->integer('property_type_id')->unsigned();
            $table->bigInteger('town_id')->unsigned();
            $table->text('description');
            $table->text('address');
            $table->string('image_full', 2084);
            $table->string('image_thumbnail', 2084);
            //got the recommended latitude and longitude storage recommendation
            //from https://developers.google.com/maps/documentation/javascript/mysql-to-maps
            $table->float('latitude', 10, 6);
            $table->float('longitude', 10, 6);
            $table->integer('num_bedrooms')->unsigned();
            $table->integer('num_bathrooms')->unsigned();
            $table->bigInteger('price')->unsigned();
            $table->bigInteger('listing_type_id')->unsigned();
            $table->timestamps();

            $table->foreign('property_type_id')->references('id')->on('property_types');
            $table->foreign('town_id')->references('id')->on('towns');
            $table->foreign('listing_type_id')->references('id')->on('listing_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
