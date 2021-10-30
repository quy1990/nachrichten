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
            $table->string('title');
            $table->text('body');

            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');

            $table->unsignedBigInteger('edited_by')->nullable();
            $table->foreign('edited_by')->references('id')->on('users')->nullOnDelete();

            $table->unsignedBigInteger('category_id');

            $table->unsignedBigInteger('status_id');

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
