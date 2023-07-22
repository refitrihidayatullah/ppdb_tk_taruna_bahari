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
        Schema::create('tb_register_siswa', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id_register_siswa');
            $table->string('jenis_pendaftaran', 20);
            $table->date('tanggal_pendaftaran_siswa');
            $table->string('masuk_rombel_siswa', 20);
            $table->unsignedBigInteger('identitas_siswa_id');
            $table->unsignedBigInteger('periodik_siswa_id')->nullable();
            $table->unsignedBigInteger('identitas_orangtua_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('identitas_siswa_id')->references('id_identitas_siswa')->on('tb_identitas_siswa')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('identitas_orangtua_id')->references('id_identitas_orangtua')->on('tb_identitas_orangtua')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('periodik_siswa_id')->references('id_periodik_siswa')->on('tb_periodik_siswa')->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('tb_register_siswa');
    }
};
