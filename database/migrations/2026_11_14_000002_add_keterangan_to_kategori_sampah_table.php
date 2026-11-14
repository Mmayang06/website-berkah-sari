<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('kategori_sampah')) {
            if (!Schema::hasColumn('kategori_sampah', 'keterangan')) {
                Schema::table('kategori_sampah', function (Blueprint $table) {
                    $table->text('keterangan')->nullable()->after('satuan');
                });
            }

            // Data keterangan berdasarkan tabel dokumen Kerja Praktik (Tabel 2.1 - 2.5)
            $dataKeterangan = [
                // Sampah Plastik (Tabel 2.1)
                'P5'  => 'Jenis sampah PP seperti cup air mineral bersih tanpa merek. Contoh: Cup air mineral bening, bersih, kering, yang sudah dipotong bibirnya. Ketentuan: Tanpa label; bibir cup dipisahkan (masuk P20).',
                'P7'  => 'Jenis sampah PP seperti ember warna. Contoh: Ember, botol oli, jerigen, kursi baso, tupperware, sendok garpu plastik (selain hitam dan abu), sedotan lembek. Ketentuan: Tutup dipisahkan; ciri sampah PP dilihat dari tanda garis pada pantat botol.',
                'P7B' => 'Tutup botol plastik (kemasan air mineral/minuman). Ketentuan: Diterima jika bersih dan bukan hitam/abu.',
                'P8'  => 'Jenis sampah PP seperti ember hitam. Contoh: Ember, botol oli, jerigen, tutup botol, sendok, garpu, sumpit, pisau plastik, gantungan baju lentur warna hitam dan abu. Ketentuan: Tutup dan gagang dipisahkan.',
                'P9'  => 'Cup minuman putih. Contoh: Cup plastik minuman putih tanpa merek (ale-ale), tutup wadah margarin (Blue Band). Ketentuan: Label dilepas; tutup mika bukan P9.',
                'P12' => 'Jenis sampah PET seperti botol plastik bening. Contoh: Botol PET kemasan air mineral bersih dan bening. Ketentuan: Tanpa tutup dan label; mulut biru (P12 Biru), mulut bening (P12 Bening); tutup masuk P7B.',
                'P14' => 'Jenis sampah PET botol plastik warna. Contoh: Botol PET kemasan minuman bersih berwarna biru atau hijau. Ketentuan: Tanpa tutup dan label; botol warna lain (cokelat, oranye) tidak diterima; tutup masuk P7B.',
                'P17' => 'Jenis sampah HD plastik kresek. Contoh: Plastik HD lembaran, kresek warna, kresek bersablon. Ketentuan: Bubble wrap hitam tidak diterima.',
                'P20' => 'Plastik keras. Contoh: Sedotan keras, helm, magicom, botol Yakult, jam dinding, mainan anak, Lego, mulut cup minuman, gantungan baju keras; plastik keras bening/kristal seperti toples kue kering dan kemasan CD/kaset. Ketentuan: Sedotan lembek masuk P7.',
                'P22' => 'Styrofoam bersih. Ketentuan: Kemasan makanan tidak diterima.',
                'P23' => 'Styrofoam kotor.',
                'P26' => 'PVC-1. Contoh: Pipa paralon, talang.',
                'P27' => 'Nylex. Contoh: Selang air, sepatu AP boot.',
                'P29' => 'Tutup galon air mineral (plastik keras, jenis Aqua refill). Ketentuan: Tutup galon plastik lembek masuk P7.',
                'P31' => 'Galon utuh tanpa bagian yang hilang (galon Aqua/plastik keras; galon Le Minerale dengan kode "galon lemin"). Ketentuan: Tutup galon masuk P7; pegangan masuk P20.',
                'P32' => 'CD/DVD, MP3, kaset PS.',
                'P34' => 'Karung plastik segala ukuran.',
                'P37' => 'Plastik bening campur. Contoh: PE, PP, OPP, plastik dengan sablon.',
                'P38' => 'Cup minuman campur. Contoh: Cup minuman kotor, ale-ale, PET bening dan PET warna yang tidak dipilah.',
                'P39' => 'Semua jenis sampah plastik yang tidak dipilah.',

                // Sampah Kertas (Tabel 2.2)
                'K1'  => 'Arsip. Contoh: HVS, buku tanpa cover, kertas putih, kertas putih yang sudah dicacah.',
                'K2'  => 'Tetrapak. Contoh: Kemasan susu kotak, teh kotak, santan instan, kopi. Ketentuan: Bersih dan gepeng; tutup dipisah ke P7B.',
                'K3'  => 'Kertas buram. Contoh: Koran bekas, kertas buram.',
                'K4'  => 'Kertas buram/koran baru. Contoh: Koran baru/bagus, kertas buram baru/bersih.',
                'K5'  => 'Majalah dupleks. Contoh: Kertas kemasan makanan, bekas undangan, kertas warna, cover majalah, cover buku, kertas warna cacah, papercup.',
                'K6'  => 'Karton/kardus. Contoh: Dus double face.',
                'K7'  => 'Kertas campur. Contoh: Campuran arsip, koran, dupleks, kertas buram, dan lainnya.',
                'K9'  => 'Dupleks telur. Contoh: Eggtray khusus telur ayam. Ketentuan: Tidak sobek.',

                // Sampah Logam (Tabel 2.3)
                'S1'  => 'Seng. Contoh: Seng lembaran, kaleng kue, kaleng susu, kaleng kopi, kaleng minuman, kaleng aerosol, rantai kalung.',
                'BS2' => 'Besi. Contoh: Paku, pagar besi, besi karat, onderdil mobil/motor/mesin, pipa besi, pelat besi.',
                'A3'  => 'Alumunium. Contoh: Kaleng alumunium, panci, alumunium foil, pelat nomor mobil dan motor.',
                'T1'  => 'Tembaga. Contoh: Kawat tembaga.',

                // Sampah Kaca dan Lain-Lain (Tabel 2.4)
                'B8'  => 'Beling. Contoh: Botol, botol obat kecil, gelas, piring, botol sirup, pecahan kaca.',
                'AK1' => 'Accu. Contoh: Accu mobil dan motor.',

                // Kategori Lainnya & Minyak Jelantah
                'lainnya'                => 'Sampah anorganik lainnya yang belum terklasifikasi.',
                'Minyak Jelantah Bening' => 'Minyak jelantah sisa penggorengan yang telah disaring dan masih jernih/bening.',
                'Minyak Jelantah Kotor'  => 'Minyak jelantah sisa penggorengan yang pekat, keruh, atau mengandung endapan kotoran.',
            ];

            foreach ($dataKeterangan as $jenis => $ket) {
                DB::table('kategori_sampah')
                    ->where('jenis', $jenis)
                    ->update(['keterangan' => $ket]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('kategori_sampah') && Schema::hasColumn('kategori_sampah', 'keterangan')) {
            Schema::table('kategori_sampah', function (Blueprint $table) {
                $table->dropColumn('keterangan');
            });
        }
    }
};
