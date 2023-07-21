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
        Schema::create('tb_identitas_siswa', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id_identitas_siswa');
            $table->unsignedBigInteger('user_id');
            $table->string('nama_lengkap_siswa', 50);
            $table->enum('jenis_kelamin_siswa', ['L', 'P']);
            $table->string('nik_siswa', 16)->unique()->nullable();
            $table->string('tempat_lahir_siswa', 20);
            $table->date('tanggal_lahir_siswa');
            $table->text('alamat_lengkap_siswa');
            $table->enum('tinggal_bersama_siswa', ['orangtua', 'wali']);
            $table->string('status_anak_ke', 2);
            $table->string('usia_siswa', 2);
            $table->string('no_hp');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_identitas_siswa');
    }
};
