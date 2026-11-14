<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('penyetoran_induk')) {
            Schema::table('penyetoran_induk', function (Blueprint $table) {
                if (!Schema::hasColumn('penyetoran_induk', 'total_berat')) {
                    $table->decimal('total_berat', 12, 2)->default(0)->after('id_pengepul');
                }
                if (!Schema::hasColumn('penyetoran_induk', 'total_pendapatan')) {
                    $table->decimal('total_pendapatan', 15, 2)->default(0)->after('total_berat');
                }
            });
        }

        if (Schema::hasTable('detail_setoran')) {
            Schema::table('detail_setoran', function (Blueprint $table) {
                if (!Schema::hasColumn('detail_setoran', 'id_penyetoran')) {
                    $table->unsignedBigInteger('id_penyetoran')->nullable()->after('harga_total');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('penyetoran_induk')) {
            Schema::table('penyetoran_induk', function (Blueprint $table) {
                if (Schema::hasColumn('penyetoran_induk', 'total_berat')) {
                    $table->dropColumn('total_berat');
                }
                if (Schema::hasColumn('penyetoran_induk', 'total_pendapatan')) {
                    $table->dropColumn('total_pendapatan');
                }
            });
        }

        if (Schema::hasTable('detail_setoran')) {
            Schema::table('detail_setoran', function (Blueprint $table) {
                if (Schema::hasColumn('detail_setoran', 'id_penyetoran')) {
                    $table->dropColumn('id_penyetoran');
                }
            });
        }
    }
};
