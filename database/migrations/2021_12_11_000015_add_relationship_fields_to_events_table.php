<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('transportation_id');
            $table->foreign('transportation_id', 'transportation_fk_5216014')->references('id')->on('transportations');
            $table->unsignedBigInteger('organizer_id');
            $table->foreign('organizer_id', 'organizer_fk_5216148')->references('id')->on('event_organizers');
        });
    }
}
