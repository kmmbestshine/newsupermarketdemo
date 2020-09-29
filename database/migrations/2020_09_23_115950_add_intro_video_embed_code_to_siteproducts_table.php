<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIntroVideoEmbedCodeToSiteproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siteproducts', function (Blueprint $table) {
            $table->text('intro_video_embed_code');
            $table->string('video_site_link',500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siteproducts', function (Blueprint $table) {
            //
        });
    }
}
