-- ====================================================================
-- OPSI 2: Jika ingin memisahkan kolom persis seperti tabel di laporan:
-- - nama_kategori (Kategori di laporan)
-- - deskripsi     (Jenis Sampah di laporan)
-- - catatan       (Ketentuan/Catatan di laporan)
-- ====================================================================

ALTER TABLE kategori_sampah 
ADD COLUMN nama_kategori VARCHAR(150) NULL AFTER jenis,
ADD COLUMN deskripsi TEXT NULL AFTER nama_kategori,
ADD COLUMN catatan TEXT NULL AFTER deskripsi;

-- Update Plastik (Tabel 2.1)
UPDATE kategori_sampah SET 
    nama_kategori = 'Jenis sampah PP seperti cup air mineral bersih tanpa merek',
    deskripsi = 'Cup air mineral bening, bersih, kering, yang sudah dipotong bibirnya',
    catatan = 'Tanpa label; bibir cup dipisahkan (masuk P20)'
WHERE jenis = 'P5';

UPDATE kategori_sampah SET 
    nama_kategori = 'Jenis sampah PP seperti ember warna',
    deskripsi = 'Ember, botol oli, jerigen, kursi baso, tupperware, sendok garpu plastik (selain hitam dan abu), sedotan lembek',
    catatan = 'Tutup dipisahkan; ciri sampah PP dilihat dari tanda garis pada pantat botol'
WHERE jenis = 'P7';

UPDATE kategori_sampah SET 
    nama_kategori = 'Tutup botol plastik',
    deskripsi = 'Tutup botol plastik',
    catatan = 'Diterima jika bersih dan bukan hitam/abu (kode P7B)'
WHERE jenis = 'P7B';

UPDATE kategori_sampah SET 
    nama_kategori = 'Jenis sampah PP seperti ember hitam',
    deskripsi = 'Ember, botol oli, jerigen, tutup botol, sendok, garpu, sumpit, pisau plastik, gantungan baju lentur warna hitam dan abu',
    catatan = 'Tutup dan gagang dipisahkan'
WHERE jenis = 'P8';

UPDATE kategori_sampah SET 
    nama_kategori = 'Cup minuman putih',
    deskripsi = 'Cup plastik minuman putih tanpa merek (ale-ale), tutup wadah margarin (Blue Band)',
    catatan = 'Label dilepas; tutup mika bukan P9'
WHERE jenis = 'P9';

UPDATE kategori_sampah SET 
    nama_kategori = 'Jenis sampah PET seperti botol plastik bening',
    deskripsi = 'Botol PET kemasan air mineral bersih dan bening',
    catatan = 'Tanpa tutup dan label; mulut biru (P12 Biru), mulut bening (P12 Bening); tutup masuk P7B'
WHERE jenis = 'P12';

UPDATE kategori_sampah SET 
    nama_kategori = 'Jenis sampah PET botol plastik warna',
    deskripsi = 'Botol PET kemasan minuman bersih berwarna biru atau hijau',
    catatan = 'Tanpa tutup dan label; botol warna lain (cokelat, oranye) tidak diterima; tutup masuk P7B'
WHERE jenis = 'P14';

UPDATE kategori_sampah SET 
    nama_kategori = 'Jenis sampah HD plastik kresek',
    deskripsi = 'Plastik HD lembaran, kresek warna, kresek bersablon',
    catatan = 'Bubble wrap hitam tidak diterima'
WHERE jenis = 'P17';

UPDATE kategori_sampah SET 
    nama_kategori = 'Plastik keras',
    deskripsi = 'Sedotan keras, helm, magicom, botol Yakult, jam dinding, mainan anak, Lego, mulut cup minuman, gantungan baju keras; plastik keras bening/kristal seperti toples kue kering dan kemasan CD/kaset',
    catatan = 'Sedotan lembek masuk P7'
WHERE jenis = 'P20';

UPDATE kategori_sampah SET 
    nama_kategori = 'Styrofoam bersih',
    deskripsi = 'Styrofoam bersih',
    catatan = 'Kemasan makanan tidak diterima'
WHERE jenis = 'P22';

UPDATE kategori_sampah SET 
    nama_kategori = 'Styrofoam kotor',
    deskripsi = 'Styrofoam kotor',
    catatan = NULL
WHERE jenis = 'P23';

UPDATE kategori_sampah SET 
    nama_kategori = 'PVC-1',
    deskripsi = 'Pipa paralon, talang',
    catatan = NULL
WHERE jenis = 'P26';

UPDATE kategori_sampah SET 
    nama_kategori = 'Nylex',
    deskripsi = 'Selang air, sepatu AP boot',
    catatan = NULL
WHERE jenis = 'P27';

UPDATE kategori_sampah SET 
    nama_kategori = 'Tutup galon',
    deskripsi = 'Tutup galon air mineral (plastik keras, jenis Aqua refill)',
    catatan = 'Tutup galon plastik lembek masuk P7'
WHERE jenis = 'P29';

UPDATE kategori_sampah SET 
    nama_kategori = 'Galon utuh',
    deskripsi = 'Galon utuh tanpa bagian yang hilang (galon Aqua/plastik keras; galon Le Minerale dengan kode "galon lemin")',
    catatan = 'Tutup galon masuk P7; pegangan masuk P20'
WHERE jenis = 'P31';

UPDATE kategori_sampah SET 
    nama_kategori = 'CD/DVD',
    deskripsi = 'CD, DVD, MP3, kaset PS',
    catatan = NULL
WHERE jenis = 'P32';

UPDATE kategori_sampah SET 
    nama_kategori = 'Karung plastik',
    deskripsi = 'Karung plastik segala ukuran',
    catatan = NULL
WHERE jenis = 'P34';

UPDATE kategori_sampah SET 
    nama_kategori = 'Plastik bening campur',
    deskripsi = 'PE, PP, OPP, plastik dengan sablon',
    catatan = NULL
WHERE jenis = 'P37';

UPDATE kategori_sampah SET 
    nama_kategori = 'Cup minuman campur',
    deskripsi = 'Cup minuman kotor, ale-ale, PET bening dan PET warna yang tidak dipilah',
    catatan = NULL
WHERE jenis = 'P38';

UPDATE kategori_sampah SET 
    nama_kategori = 'Plastik campur',
    deskripsi = 'Semua jenis sampah plastik yang tidak dipilah',
    catatan = NULL
WHERE jenis = 'P39';

-- Update Kertas (Tabel 2.2)
UPDATE kategori_sampah SET 
    nama_kategori = 'Arsip',
    deskripsi = 'HVS, buku tanpa cover, kertas putih, kertas putih yang sudah dicacah',
    catatan = NULL
WHERE jenis = 'K1';

UPDATE kategori_sampah SET 
    nama_kategori = 'Tetrapak',
    deskripsi = 'Kemasan susu kotak, teh kotak, santan instan, kopi',
    catatan = 'Bersih dan gepeng; tutup dipisah ke P7B'
WHERE jenis = 'K2';

UPDATE kategori_sampah SET 
    nama_kategori = 'Kertas buram',
    deskripsi = 'Koran bekas, kertas buram',
    catatan = NULL
WHERE jenis = 'K3';

UPDATE kategori_sampah SET 
    nama_kategori = 'Kertas buram',
    deskripsi = 'Koran baru/bagus, kertas buram baru/bersih',
    catatan = NULL
WHERE jenis = 'K4';

UPDATE kategori_sampah SET 
    nama_kategori = 'Majalah dupleks',
    deskripsi = 'Kertas kemasan makanan, bekas undangan, kertas warna, cover majalah, cover buku, kertas warna cacah, papercup',
    catatan = NULL
WHERE jenis = 'K5';

UPDATE kategori_sampah SET 
    nama_kategori = 'Karton/kardus',
    deskripsi = 'Dus double face',
    catatan = NULL
WHERE jenis = 'K6';

UPDATE kategori_sampah SET 
    nama_kategori = 'Kertas campur',
    deskripsi = 'Campuran arsip, koran, dupleks, kertas buram, dan lainnya',
    catatan = NULL
WHERE jenis = 'K7';

UPDATE kategori_sampah SET 
    nama_kategori = 'Dupleks telur',
    deskripsi = 'Eggtray khusus telur ayam',
    catatan = 'Tidak sobek'
WHERE jenis = 'K9';

-- Update Logam (Tabel 2.3)
UPDATE kategori_sampah SET 
    nama_kategori = 'Seng',
    deskripsi = 'Seng lembaran, kaleng kue, kaleng susu, kaleng kopi, kaleng minuman, kaleng aerosol, rantai kalung',
    catatan = NULL
WHERE jenis = 'S1';

UPDATE kategori_sampah SET 
    nama_kategori = 'Besi',
    deskripsi = 'Paku, pagar besi, besi karat, onderdil mobil/motor/mesin, pipa besi, pelat besi',
    catatan = NULL
WHERE jenis = 'BS2';

UPDATE kategori_sampah SET 
    nama_kategori = 'Alumunium',
    deskripsi = 'Kaleng alumunium, panci, alumunium foil, pelat nomor mobil dan motor',
    catatan = NULL
WHERE jenis = 'A3';

UPDATE kategori_sampah SET 
    nama_kategori = 'Tembaga',
    deskripsi = 'Kawat tembaga',
    catatan = NULL
WHERE jenis = 'T1';

-- Update Kaca & Lain-Lain (Tabel 2.4)
UPDATE kategori_sampah SET 
    nama_kategori = 'Beling',
    deskripsi = 'Botol, botol obat kecil, gelas, piring, botol sirup, pecahan kaca',
    catatan = NULL
WHERE jenis = 'B8';

UPDATE kategori_sampah SET 
    nama_kategori = 'Accu',
    deskripsi = 'Accu mobil dan motor',
    catatan = NULL
WHERE jenis = 'AK1';

-- Update Lainnya & Minyak Jelantah
UPDATE kategori_sampah SET 
    nama_kategori = 'Lainnya',
    deskripsi = 'Sampah anorganik lainnya yang belum terklasifikasi',
    catatan = NULL
WHERE jenis = 'lainnya';

UPDATE kategori_sampah SET 
    nama_kategori = 'Minyak Jelantah',
    deskripsi = 'Minyak jelantah sisa penggorengan yang telah disaring dan masih jernih/bening',
    catatan = NULL
WHERE jenis = 'Minyak Jelantah Bening';

UPDATE kategori_sampah SET 
    nama_kategori = 'Minyak Jelantah',
    deskripsi = 'Minyak jelantah sisa penggorengan yang pekat, keruh, atau mengandung endapan kotoran',
    catatan = NULL
WHERE jenis = 'Minyak Jelantah Kotor';
