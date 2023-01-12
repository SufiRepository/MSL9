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
        Schema::create('resources', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('availability')->nullable();
            $table->integer('assigned_to')->nullable();
            $table->date('mainenance_schedule')->nullable();
            $table->decimal('cost', 20, 6)->nullable();
            $table->string('image')->nullable();
            $table->string('manual_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
};
