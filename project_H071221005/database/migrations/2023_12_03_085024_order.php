<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('akun_user');
            $table->string('nama');
            $table->string('email');
            $table->string('no_telp');
            $table->integer('durasi_rental');
            $table->string('ktp_user');
            $table->string('sim_user')->nullable();
            $table->string('id_mobil');
            $table->string('id_driver')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
