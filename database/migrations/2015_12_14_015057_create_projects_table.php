<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('owner_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->string('progress');
            $table->string('status');
            $table->date('due_date');
            $table->timestamps();
            $table->foreign('client_id')
                ->references('id')->on('clients');
            $table->foreign('owner_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}
