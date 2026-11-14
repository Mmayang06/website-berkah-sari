<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('penyetoran_induk')) {
            Schema::create('penyetoran_induk', function (Blueprint $table) {
                $table->id('id_penyetoran');
                $table->string('kelompok', 50);
                $table->integer('bulan');
                $table->integer('tahun');
                $table->unsignedBigInteger('id_pengepul');
                $table->date('tanggal_setor')->nullable();
                $table->text('catatan')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('penyetoran_induk');
    }
};
