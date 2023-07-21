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
        Schema::create('tb_periodik_siswa', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id_periodik_siswa');
            $table->unsignedBigInteger('identitas_siswa_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('tinggi_badan_siswa', 3);
            $table->string('berat_badan_siswa', 3);
            $table->string('jarak_tempuh_siswa');
            $table->string('jumlah_saudara_siswa', 2);

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
        Schema::dropIfExists('tb_periodik_siswa');
    }
};
