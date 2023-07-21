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
        Schema::create('tb_identitas_orangtua', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id_identitas_orangtua');
            $table->unsignedBigInteger('identitas_siswa_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_orangtua', 50);
            $table->string('status_orangtua', 1);
            $table->string('nik_orangtua', 16)->unique();
            $table->date('tanggal_lahir_orangtua');
            $table->string('pendidikan_orangtua');
            $table->string('pekerjaan_orangtua');
            $table->foreign('identitas_siswa_id')->references('id_identitas_siswa')->on('tb_identitas_siswa')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('tb_identitas_orangtua');
    }
};
