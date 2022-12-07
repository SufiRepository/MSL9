<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name', 191);
            $table->string('description')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('estimated_budget', 50)->nullable();
            $table->string('spent_budget', 50)->nullable();
            $table->string('project_duration', 50)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedInteger('location_id')->nullable();
            $table->unsignedInteger('client_id')->nullable();
            $table->unsignedInteger('contractor_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
