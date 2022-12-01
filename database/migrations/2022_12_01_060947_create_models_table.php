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
        Schema::create('models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('model_number', 191)->nullable();
            $table->integer('manufacturer_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->timestamps();
            $table->integer('depreciation_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('eol')->nullable();
            $table->string('image', 191)->nullable();
            $table->boolean('deprecated_mac_address')->default(false);
            $table->softDeletes();
            $table->integer('fieldset_id')->nullable();
            $table->text('notes')->nullable();
            $table->tinyInteger('requestable')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models');
    }
};
