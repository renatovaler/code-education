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
            $table->integer('owner_id')->unsigned(); //(chave estrangeira para users)
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('client_id')->unsigned(); //(chave estrangeira para clients)
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('progress')->default(0);
            $table->integer('status')->default(0);
            $table->dateTime('due_date');
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
        Schema::drop('projects', function (Blueprint $table) {
            $table->dropForeign('projects_owner_id_foreign');
            $table->dropForeign('projects_client_id_foreign');
        });
    }
}
