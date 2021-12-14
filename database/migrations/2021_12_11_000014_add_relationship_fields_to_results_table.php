<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToResultsTable extends Migration
{
    public function up()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_fk_5555751')->references('id')->on('events');
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id', 'member_fk_5555752')->references('id')->on('users');
        });
    }
}
