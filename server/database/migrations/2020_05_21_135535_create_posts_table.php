<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->index()->nullable();
            $table->unsignedInteger('category_id')->index()->nullable();
            $table->string('slug');
            $table->string('title')->nullable()->default('New post');
            $table->string('subtitle')->nullable()->default('');
            $table->text('meta_desc')->nullable();
            $table->mediumText('post_body')->nullable();
            $table->dateTime('posted_at')->index()->nullable()
                ->comment('Public posted at time, if this is in future then it wont appear yet');
            $table->boolean('is_published')->default(true);
            $table->string('image_large')->nullable();
            $table->string('image_medium')->nullable();
            $table->string('image_thumbnail')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
