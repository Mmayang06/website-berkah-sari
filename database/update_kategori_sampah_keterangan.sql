-- ====================================================================
-- Script Update Keterangan pada Tabel kategori_sampah
-- Database: db_berkah_sari
-- ====================================================================

-- 1. Tambah kolom 'keterangan' jika belum ada
ALTER TABLE kategori_sampah 
ADD COLUMN keterangan TEXT NULL AFTER satuan;

-- 2. Update Keterangan untuk Kategori Sampah Plastik (Tabel 2.1)
UPDATE kategori_sampah 
SET keterangan = 'Jenis sampah PP seperti cup air mineral bersih tanpa merek. Contoh: Cup air mineral bening, bersih, kering, yang sudah dipotong bibirnya. Ketentuan: Tanpa label; bibir cup dipisahkan (masuk P20).' 
WHERE jenis = 'P5';

UPDATE kategori_sampah 
SET keterangan = 'Jenis sampah PP seperti ember warna. Contoh: Ember, botol oli, jerigen, kursi baso, tupperware, sendok garpu plastik (selain hitam dan abu), sedotan lembek. Ketentuan: Tutup dipisahkan; ciri sampah PP dilihat dari tanda garis pada pantat botol.' 
WHERE jenis = 'P7';

UPDATE kategori_sampah 
SET keterangan = 'Tutup botol plastik (kemasan air mineral/minuman). Ketentuan: Diterima jika bersih dan bukan hitam/abu.' 
WHERE jenis = 'P7B';

UPDATE kategori_sampah 
SET keterangan = 'Jenis sampah PP seperti ember hitam. Contoh: Ember, botol oli, jerigen, tutup botol, sendok, garpu, sumpit, pisau plastik, gantungan baju lentur warna hitam dan abu. Ketentuan: Tutup dan gagang dipisahkan.' 
WHERE jenis = 'P8';

UPDATE kategori_sampah 
SET keterangan = 'Cup minuman putih. Contoh: Cup plastik minuman putih tanpa merek (ale-ale), tutup wadah margarin (Blue Band). Ketentuan: Label dilepas; tutup mika bukan P9.' 
WHERE jenis = 'P9';

UPDATE kategori_sampah 
SET keterangan = 'Jenis sampah PET seperti botol plastik bening. Contoh: Botol PET kemasan air mineral bersih dan bening. Ketentuan: Tanpa tutup dan label; mulut biru (P12 Biru), mulut bening (P12 Bening); tutup masuk P7B.' 
WHERE jenis = 'P12';

UPDATE kategori_sampah 
SET keterangan = 'Jenis sampah PET botol plastik warna. Contoh: Botol PET kemasan minuman bersih berwarna biru atau hijau. Ketentuan: Tanpa tutup dan label; botol warna lain (cokelat, oranye) tidak diterima; tutup masuk P7B.' 
WHERE jenis = 'P14';

UPDATE kategori_sampah 
SET keterangan = 'Jenis sampah HD plastik kresek. Contoh: Plastik HD lembaran, kresek warna, kresek bersablon. Ketentuan: Bubble wrap hitam tidak diterima.' 
WHERE jenis = 'P17';

UPDATE kategori_sampah 
SET keterangan = 'Plastik keras. Contoh: Sedotan keras, helm, magicom, botol Yakult, jam dinding, mainan anak, Lego, mulut cup minuman, gantungan baju keras; plastik keras bening/kristal seperti toples kue kering dan kemasan CD/kaset. Ketentuan: Sedotan lembek masuk P7.' 
WHERE jenis = 'P20';

UPDATE kategori_sampah 
SET keterangan = 'Styrofoam bersih. Ketentuan: Kemasan makanan tidak diterima.' 
WHERE jenis = 'P22';

UPDATE kategori_sampah 
SET keterangan = 'Styrofoam kotor.' 
WHERE jenis = 'P23';

UPDATE kategori_sampah 
SET keterangan = 'PVC-1. Contoh: Pipa paralon, talang.' 
WHERE jenis = 'P26';

UPDATE kategori_sampah 
SET keterangan = 'Nylex. Contoh: Selang air, sepatu AP boot.' 
WHERE jenis = 'P27';

UPDATE kategori_sampah 
SET keterangan = 'Tutup galon air mineral (plastik keras, jenis Aqua refill). Ketentuan: Tutup galon plastik lembek masuk P7.' 
WHERE jenis = 'P29';

UPDATE kategori_sampah 
SET keterangan = 'Galon utuh tanpa bagian yang hilang (galon Aqua/plastik keras; galon Le Minerale dengan kode "galon lemin"). Ketentuan: Tutup galon masuk P7; pegangan masuk P20.' 
WHERE jenis = 'P31';

UPDATE kategori_sampah 
SET keterangan = 'CD/DVD, MP3, kaset PS.' 
WHERE jenis = 'P32';

UPDATE kategori_sampah 
SET keterangan = 'Karung plastik segala ukuran.' 
WHERE jenis = 'P34';

UPDATE kategori_sampah 
SET keterangan = 'Plastik bening campur. Contoh: PE, PP, OPP, plastik dengan sablon.' 
WHERE jenis = 'P37';

UPDATE kategori_sampah 
SET keterangan = 'Cup minuman campur. Contoh: Cup minuman kotor, ale-ale, PET bening dan PET warna yang tidak dipilah.' 
WHERE jenis = 'P38';

UPDATE kategori_sampah 
SET keterangan = 'Semua jenis sampah plastik yang tidak dipilah.' 
WHERE jenis = 'P39';

-- 3. Update Keterangan untuk Kategori Sampah Kertas (Tabel 2.2)
UPDATE kategori_sampah 
SET keterangan = 'Arsip. Contoh: HVS, buku tanpa cover, kertas putih, kertas putih yang sudah dicacah.' 
WHERE jenis = 'K1';

UPDATE kategori_sampah 
SET keterangan = 'Tetrapak. Contoh: Kemasan susu kotak, teh kotak, santan instan, kopi. Ketentuan: Bersih dan gepeng; tutup dipisah ke P7B.' 
WHERE jenis = 'K2';

UPDATE kategori_sampah 
SET keterangan = 'Kertas buram. Contoh: Koran bekas, kertas buram.' 
WHERE jenis = 'K3';

UPDATE kategori_sampah 
SET keterangan = 'Kertas buram/koran baru. Contoh: Koran baru/bagus, kertas buram baru/bersih.' 
WHERE jenis = 'K4';

UPDATE kategori_sampah 
SET keterangan = 'Majalah dupleks. Contoh: Kertas kemasan makanan, bekas undangan, kertas warna, cover majalah, cover buku, kertas warna cacah, papercup.' 
WHERE jenis = 'K5';

UPDATE kategori_sampah 
SET keterangan = 'Karton/kardus. Contoh: Dus double face.' 
WHERE jenis = 'K6';

UPDATE kategori_sampah 
SET keterangan = 'Kertas campur. Contoh: Campuran arsip, koran, dupleks, kertas buram, dan lainnya.' 
WHERE jenis = 'K7';

UPDATE kategori_sampah 
SET keterangan = 'Dupleks telur. Contoh: Eggtray khusus telur ayam. Ketentuan: Tidak sobek.' 
WHERE jenis = 'K9';

-- 4. Update Keterangan untuk Kategori Sampah Logam (Tabel 2.3)
UPDATE kategori_sampah 
SET keterangan = 'Seng. Contoh: Seng lembaran, kaleng kue, kaleng susu, kaleng kopi, kaleng minuman, kaleng aerosol, rantai kalung.' 
WHERE jenis = 'S1';

UPDATE kategori_sampah 
SET keterangan = 'Besi. Contoh: Paku, pagar besi, besi karat, onderdil mobil/motor/mesin, pipa besi, pelat besi.' 
WHERE jenis = 'BS2';

UPDATE kategori_sampah 
SET keterangan = 'Alumunium. Contoh: Kaleng alumunium, panci, alumunium foil, pelat nomor mobil dan motor.' 
WHERE jenis = 'A3';

UPDATE kategori_sampah 
SET keterangan = 'Tembaga. Contoh: Kawat tembaga.' 
WHERE jenis = 'T1';

-- 5. Update Keterangan untuk Kategori Sampah Kaca dan Lain-Lain (Tabel 2.4)
UPDATE kategori_sampah 
SET keterangan = 'Beling. Contoh: Botol, botol obat kecil, gelas, piring, botol sirup, pecahan kaca.' 
WHERE jenis = 'B8';

UPDATE kategori_sampah 
SET keterangan = 'Accu. Contoh: Accu mobil dan motor.' 
WHERE jenis = 'AK1';

-- 6. Update Keterangan untuk Kategori Lainnya & Minyak Jelantah
UPDATE kategori_sampah 
SET keterangan = 'Sampah anorganik lainnya yang belum terklasifikasi.' 
WHERE jenis = 'lainnya';

UPDATE kategori_sampah 
SET keterangan = 'Minyak jelantah sisa penggorengan yang telah disaring dan masih jernih/bening.' 
WHERE jenis = 'Minyak Jelantah Bening';

UPDATE kategori_sampah 
SET keterangan = 'Minyak jelantah sisa penggorengan yang pekat, keruh, atau mengandung endapan kotoran.' 
WHERE jenis = 'Minyak Jelantah Kotor';
