<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('tabungan_lingkungan')) {
            Schema::create('tabungan_lingkungan', function (Blueprint $table) {
                $table->id('id_tabungan');
                $table->unsignedBigInteger('id_lingkungan');
                $table->integer('bulan');
                $table->integer('tahun');
                $table->decimal('nominal', 15, 2)->default(0);
                $table->string('status', 20)->default('Ditabung');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tabungan_lingkungan');
    }
};

