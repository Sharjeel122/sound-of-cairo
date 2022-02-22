<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');

            $table->unsignedBigInteger('tag_id')->nullable();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');


            $table->unsignedBigInteger('moderator_id')->nullable();
            $table->foreign('moderator_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->string('uploaded_date'); 
            $table->string('song');
            $table->string('format')->nullable();
            $table->string('prov_rate')->nullable();
            $table->string('upvote')->nullable();
            $table->string('duration')->default('0');
            $table->string('medium')->nullable();
            $table->string('information')->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->default(true);
            $table->string('sound_status')->default('Rejected');
            $table->boolean('is_downloadable')->default(true);
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
        Schema::dropIfExists('sounds');
    }
}
