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
        Schema::create('profiles', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('user_id', 50)->nullable();
            $table->string('nama_penuh', 225)->nullable();
            $table->string('email', 225)->nullable();
            $table->string('kategori', 225)->nullable();
            $table->string('no_tentera', 225)->nullable();
            $table->string('no_ic', 225)->nullable();
            $table->date('t_lahir')->nullable();
            $table->string('jantina', 225)->nullable();
            $table->string('no_phone', 225)->nullable();
            $table->string('pasukan_id', 50)->nullable();
            $table->string('pangkat_id', 50)->nullable();
            $table->string('jawatan_id', 50)->nullable();
            $table->string('agama_id', 50)->nullable();
            $table->string('bangsa_id', 50)->nullable();
            $table->string('status_anggota', 225)->nullable();
            $table->string('status_akaun', 15)->nullable();
            $table->string('taraf_kahwin', 225)->nullable();
            $table->string('created_by', 50)->nullable();
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
        Schema::dropIfExists('profiles');
    }
};
