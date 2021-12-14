<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportationsTable extends Migration
{
    public function up()
    {
        Schema::create('transportations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('transportation_type');
            $table->string('dep_place');
            $table->datetime('dep_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
