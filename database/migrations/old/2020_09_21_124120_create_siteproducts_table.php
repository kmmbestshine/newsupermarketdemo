<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteproducts', function (Blueprint $table) {
             $table->increments('id');
            $table->text('name');
            $table->text('category');
            $table->float('price',8,2);
            $table->longtext('description');
            $table->longtext('full_descript')->nullable();
            $table->text('image');
            $table->text('mul_images')->nullable();
            $table->string('website')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->float('studentprice')->nullable();
            $table->string('twitter')->nullable();
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
        Schema::dropIfExists('siteproducts');
    }
}
