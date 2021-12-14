<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_5215892')->references('id')->on('users');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_fk_5216734')->references('id')->on('post_categories');
        });
    }
}
