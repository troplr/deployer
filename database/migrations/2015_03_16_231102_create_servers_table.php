<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use REBELinBLUE\Deployer\ProjectServer;
use REBELinBLUE\Deployer\Server;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ip_address');
            $table->string('user');
            $table->string('path');
            $table->unsignedInteger('project_id');
            $table->enum('status', [ProjectServer::SUCCESSFUL, ProjectServer::TESTING,
                                    ProjectServer::FAILED, ProjectServer::UNTESTED,])->default(ProjectServer::UNTESTED);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('project_id')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('servers');
    }
}
