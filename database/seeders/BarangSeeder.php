<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->truncate();

        DB::table('barang')->insert([
            [
                'id' => 3,
                'namabarang' => 'Amplop Coklat Ukuran Besar',
                'created_at' => '2024-10-16 09:19:24',
                'updated_at' => '2024-10-16 09:19:24',
            ],
            [
                'id' => 4,
                'namabarang' => 'Amplop Coklat Ukuran Kecil',
                'created_at' => '2024-10-16 09:20:38',
                'updated_at' => '2024-10-16 09:20:38',
            ],
            [
                'id' => 5,
                'namabarang' => 'Amplop Putih',
                'created_at' => '2024-10-16 09:21:00',
                'updated_at' => '2024-10-16 09:21:00',
            ],
            [
                'id' => 6,
                'namabarang' => 'Amplop Surat Putih Plastik',
                'created_at' => '2024-10-16 09:21:18',
                'updated_at' => '2024-10-16 09:21:18',
            ],
            [
                'id' => 7,
                'namabarang' => 'Amplop Uang Besar',
                'created_at' => '2024-10-16 09:28:54',
                'updated_at' => '2024-10-16 09:28:54',
            ],
            [
                'id' => 8,
                'namabarang' => 'Amplop Uang Kecil',
                'created_at' => '2024-10-16 09:29:18',
                'updated_at' => '2024-10-16 09:29:18',
            ],
            [
                'id' => 9,
                'namabarang' => 'Amplop Uang Sedang',
                'created_at' => '2024-10-16 09:29:35',
                'updated_at' => '2024-10-16 09:29:35',
            ],
            [
                'id' => 10,
                'namabarang' => 'Analisa Kredit Halaman 1',
                'created_at' => '2024-10-16 09:29:58',
                'updated_at' => '2024-10-16 09:29:58',
            ],
            [
                'id' => 11,
                'namabarang' => 'Analisa Kredit Halaman 2',
                'created_at' => '2024-10-16 09:30:11',
                'updated_at' => '2024-10-16 09:30:11',
            ],
            [
                'id' => 12,
                'namabarang' => 'Analisa Kredit Halaman 3',
                'created_at' => '2024-10-16 09:30:23',
                'updated_at' => '2024-10-16 09:30:23',
            ],
            [
                'id' => 13,
                'namabarang' => 'Aplikasi Permohonan Kredit Halaman 1',
                'created_at' => '2024-10-16 09:30:48',
                'updated_at' => '2024-10-16 09:30:48',
            ],
            [
                'id' => 14,
                'namabarang' => 'Aplikasi Permohonan Kredit Halaman 2',
                'created_at' => '2024-10-16 09:30:59',
                'updated_at' => '2024-10-16 09:30:59',
            ],
            [
                'id' => 15,
                'namabarang' => 'Berita Acara Komite Kredit PT.Bpr Karya Utama Jabar',
                'created_at' => '2024-10-16 09:31:38',
                'updated_at' => '2024-10-16 09:31:38',
            ],
            [
                'id' => 16,
                'namabarang' => 'Berita Acara Pemeriksaan Jaminan Agunan',
                'created_at' => '2024-10-17 08:47:40',
                'updated_at' => '2024-10-17 08:47:40',
            ],
            [
                'id' => 17,
                'namabarang' => 'Bilyet Deposito',
                'created_at' => '2024-10-17 08:47:53',
                'updated_at' => '2024-10-17 08:47:53',
            ],
            [
                'id' => 18,
                'namabarang' => 'Bukti Penerimaan/Penyerahan Barang/Dokumen Agunan Kredit',
                'created_at' => '2024-10-17 08:48:14',
                'updated_at' => '2024-10-17 08:48:14',
            ],
            [
                'id' => 19,
                'namabarang' => 'Buku Tabungan Sekolah',
                'created_at' => '2024-10-17 08:48:55',
                'updated_at' => '2024-10-17 08:48:55',
            ],
            [
                'id' => 20,
                'namabarang' => 'Buku Tabungan Tamasya Ku',
                'created_at' => '2024-10-17 08:49:28',
                'updated_at' => '2024-10-17 08:49:28',
            ],
            [
                'id' => 21,
                'namabarang' => 'Buku Tabungan Tas Ku',
                'created_at' => '2024-10-17 08:49:58',
                'updated_at' => '2024-10-17 08:49:58',
            ],
            [
                'id' => 22,
                'namabarang' => 'Buku Tabunganku Berjangka',
                'created_at' => '2024-10-17 08:50:14',
                'updated_at' => '2024-10-17 08:50:14',
            ],
            [
                'id' => 23,
                'namabarang' => 'Formulir Data Nasabah',
                'created_at' => '2024-10-17 08:50:38',
                'updated_at' => '2024-10-17 08:50:38',
            ],
            [
                'id' => 24,
                'namabarang' => 'Formulir Pembukaan Rekening',
                'created_at' => '2024-10-17 08:50:55',
                'updated_at' => '2024-10-17 08:51:33',
            ],
            [
                'id' => 25,
                'namabarang' => 'Formulir Umum',
                'created_at' => '2024-10-17 08:51:51',
                'updated_at' => '2024-10-17 08:51:51',
            ],
            [
                'id' => 26,
                'namabarang' => 'Ikatan Uang Rp. 1.000',
                'created_at' => '2024-10-17 08:52:12',
                'updated_at' => '2024-10-17 08:52:12',
            ],
            [
                'id' => 27,
                'namabarang' => 'Ikatan Uang Rp. 2.000',
                'created_at' => '2024-10-17 08:52:55',
                'updated_at' => '2024-10-17 08:52:55',
            ],
            [
                'id' => 28,
                'namabarang' => 'Ikatan Uang Rp. 5.000',
                'created_at' => '2024-10-17 08:53:16',
                'updated_at' => '2024-10-17 08:53:16',
            ],
            [
                'id' => 29,
                'namabarang' => 'Ikatan Uang Rp. 10.000',
                'created_at' => '2024-10-17 08:53:43',
                'updated_at' => '2024-10-17 08:53:43',
            ],
            [
                'id' => 30,
                'namabarang' => 'Ikatan Uang Rp. 20.000',
                'created_at' => '2024-10-17 08:53:58',
                'updated_at' => '2024-10-17 08:53:58',
            ],
            [
                'id' => 31,
                'namabarang' => 'Ikatan Uang Rp. 50.000',
                'created_at' => '2024-10-17 08:54:25',
                'updated_at' => '2024-10-17 08:54:25',
            ],
            [
                'id' => 32,
                'namabarang' => 'Ikatan Uang Rp. 100.000',
                'created_at' => '2024-10-17 08:54:43',
                'updated_at' => '2024-10-17 08:54:43',
            ],
            [
                'id' => 33,
                'namabarang' => 'Kalender 6 Lembar Gambar',
                'created_at' => '2024-10-17 08:55:28',
                'updated_at' => '2024-10-17 08:55:28',
            ],
            [
                'id' => 34,
                'namabarang' => 'Kalender Bulanan Pertanggal',
                'created_at' => '2024-10-17 08:55:43',
                'updated_at' => '2024-10-17 08:55:43',
            ],
            [
                'id' => 35,
                'namabarang' => 'Kalender Dinding',
                'created_at' => '2024-10-17 08:58:24',
                'updated_at' => '2024-10-17 08:58:24',
            ],
            [
                'id' => 36,
                'namabarang' => 'Kalender Meja',
                'created_at' => '2024-10-17 08:58:39',
                'updated_at' => '2024-10-17 08:58:39',
            ],
            [
                'id' => 37,
                'namabarang' => 'Kartu Anggaran Bunga Deposito',
                'created_at' => '2024-10-17 08:59:01',
                'updated_at' => '2024-10-17 08:59:01',
            ],
            [
                'id' => 38,
                'namabarang' => 'Kartu Contoh Tanda Tangan Nasabah',
                'created_at' => '2024-10-17 08:59:20',
                'updated_at' => '2024-10-17 08:59:20',
            ],
            [
                'id' => 39,
                'namabarang' => 'Kartu Nama Pengurus Dan Pegawai',
                'created_at' => '2024-10-17 09:01:57',
                'updated_at' => '2024-10-17 09:01:57',
            ],
            [
                'id' => 40,
                'namabarang' => 'Kartu Penerus Disposisi',
                'created_at' => '2024-10-17 09:02:17',
                'updated_at' => '2024-10-17 09:02:17',
            ],
            [
                'id' => 41,
                'namabarang' => 'Kartu Pinjaman Warna Kuning',
                'created_at' => '2024-10-17 09:02:37',
                'updated_at' => '2024-10-17 09:02:37',
            ],
            [
                'id' => 42,
                'namabarang' => 'Kartu Pinjaman Warna Merah',
                'created_at' => '2024-10-17 09:02:58',
                'updated_at' => '2024-10-17 09:02:58',
            ],
            [
                'id' => 43,
                'namabarang' => 'Kartu Ucapan Idul Fitri',
                'created_at' => '2024-10-17 09:03:08',
                'updated_at' => '2024-10-17 09:03:08',
            ],
            [
                'id' => 44,
                'namabarang' => 'Kwitansi',
                'created_at' => '2024-10-17 09:03:22',
                'updated_at' => '2024-10-17 09:03:22',
            ],
            [
                'id' => 45,
                'namabarang' => 'Map Berkas Agunan Kredit Konsumtif Warna Kuning',
                'created_at' => '2024-10-17 09:03:43',
                'updated_at' => '2024-10-17 09:03:43',
            ],
            [
                'id' => 46,
                'namabarang' => 'Map Berkas Agunan Kredit Produktif Warna Biru',
                'created_at' => '2024-10-17 09:04:33',
                'updated_at' => '2024-10-17 09:04:33',
            ],
            [
                'id' => 47,
                'namabarang' => 'Map Bilyet Deposito',
                'created_at' => '2024-10-17 09:04:43',
                'updated_at' => '2024-10-17 09:04:43',
            ],
            [
                'id' => 48,
                'namabarang' => 'Map Biru Kantor Pusat',
                'created_at' => '2024-10-17 09:05:00',
                'updated_at' => '2024-10-17 09:05:00',
            ],
            [
                'id' => 49,
                'namabarang' => 'Map Deposan Warna Hijau',
                'created_at' => '2024-10-17 09:05:10',
                'updated_at' => '2024-10-17 09:05:10',
            ],
            [
                'id' => 50,
                'namabarang' => 'Map Kredit Konsumtif Warna Kuning',
                'created_at' => '2024-10-17 09:06:09',
                'updated_at' => '2024-10-17 09:06:09',
            ],
            [
                'id' => 51,
                'namabarang' => 'Map Kredit Produktif Warna Biru',
                'created_at' => '2024-10-17 09:06:31',
                'updated_at' => '2024-10-17 09:06:31',
            ],
            [
                'id' => 52,
                'namabarang' => 'Map Kredit Yang Dijamin Deposito Warna Hijau',
                'created_at' => '2024-10-17 09:07:08',
                'updated_at' => '2024-10-17 09:07:08',
            ],
            [
                'id' => 53,
                'namabarang' => 'Nametag',
                'created_at' => '2024-10-17 09:07:54',
                'updated_at' => '2024-10-17 09:07:54',
            ],
            [
                'id' => 54,
                'namabarang' => 'Nota Tanda Terima Barang Carbonis',
                'created_at' => '2024-10-17 09:08:12',
                'updated_at' => '2024-10-17 09:08:12',
            ],
            [
                'id' => 55,
                'namabarang' => 'Permohonan Penutupan Deposito',
                'created_at' => '2024-10-17 09:08:34',
                'updated_at' => '2024-10-17 09:08:34',
            ],
            [
                'id' => 56,
                'namabarang' => 'Slip Penarikan',
                'created_at' => '2024-10-17 09:08:58',
                'updated_at' => '2024-10-17 09:08:58',
            ],
            [
                'id' => 57,
                'namabarang' => 'Slip Surat Penerimaan Uang',
                'created_at' => '2024-10-17 09:09:20',
                'updated_at' => '2024-10-17 09:09:20',
            ],
            [
                'id' => 58,
                'namabarang' => 'Slip Surat Perintah Pengeluaran Uang',
                'created_at' => '2024-10-17 09:09:38',
                'updated_at' => '2024-10-17 09:09:38',
            ],
            [
                'id' => 59,
                'namabarang' => 'Surat Keterangan Agunan Yang Tidak Diasuransikan',
                'created_at' => '2024-10-17 09:09:53',
                'updated_at' => '2024-10-17 09:09:53',
            ],
            [
                'id' => 60,
                'namabarang' => 'Surat Keterangan Dari Desa',
                'created_at' => '2024-10-17 09:10:08',
                'updated_at' => '2024-10-17 09:10:08',
            ],
            [
                'id' => 61,
                'namabarang' => 'Surat Keterangan Jaminan Bpkb',
                'created_at' => '2024-10-17 09:10:24',
                'updated_at' => '2024-10-17 09:10:24',
            ],
            [
                'id' => 62,
                'namabarang' => 'Surat Keterangan Perincian Gaji',
                'created_at' => '2024-10-17 09:10:37',
                'updated_at' => '2024-10-17 09:10:37',
            ],
            [
                'id' => 63,
                'namabarang' => 'Surat Kuasa Jaminan Deposito',
                'created_at' => '2024-10-17 09:10:54',
                'updated_at' => '2024-10-17 09:10:54',
            ],
            [
                'id' => 64,
                'namabarang' => 'Surat Kuasa Jaminan Surat Tanah',
                'created_at' => '2024-10-17 09:11:08',
                'updated_at' => '2024-10-17 09:11:08',
            ],
            [
                'id' => 65,
                'namabarang' => 'Surat Kuasa Kredit Sertifikasi Pendidik',
                'created_at' => '2024-10-17 09:11:19',
                'updated_at' => '2024-10-17 09:11:19',
            ],
            [
                'id' => 66,
                'namabarang' => 'Surat Kuasa Pemotongan Tunjangan Sertifikasi Pendidik',
                'created_at' => '2024-10-17 09:11:38',
                'updated_at' => '2024-10-17 09:11:38',
            ],
            [
                'id' => 67,
                'namabarang' => 'Surat Kuasa Pemotongan Tunjangan Sertifikasi Pendidik Via Bank Bjb',
                'created_at' => '2024-10-17 09:15:26',
                'updated_at' => '2024-10-17 09:15:26',
            ],
            [
                'id' => 68,
                'namabarang' => 'Surat Kuasa Pencairan Deposito',
                'created_at' => '2024-10-17 09:15:43',
                'updated_at' => '2024-10-17 09:15:43',
            ],
            [
                'id' => 69,
                'namabarang' => 'Surat Kuasa Penyerahan Buku Tabungan Dan Katu ATM',
                'created_at' => '2024-10-17 09:17:37',
                'updated_at' => '2024-10-17 09:17:37',
            ],
            [
                'id' => 70,
                'namabarang' => 'Surat Kuasa Substitusi Pemotong Gaji (Pns/Cpns)',
                'created_at' => '2024-10-17 09:17:54',
                'updated_at' => '2024-10-17 09:17:54',
            ],
            [
                'id' => 71,
                'namabarang' => 'SKMB Yang Dijadikan Jaminan Pada Pt.Bpr Karya Utama Jabar Diserahkan Bebas Dari Segala Beban Pajak',
                'created_at' => '2024-10-17 09:21:06',
                'updated_at' => '2024-10-17 09:21:06',
            ],
            [
                'id' => 72,
                'namabarang' => 'Surat Permohonan Asuransi',
                'created_at' => '2024-10-17 09:23:43',
                'updated_at' => '2024-10-17 09:23:43',
            ],
            [
                'id' => 73,
                'namabarang' => 'Surat Pernyataan Bendaharawan/Juru Bayar',
                'created_at' => '2024-10-17 09:23:56',
                'updated_at' => '2024-10-17 09:23:56',
            ],
            [
                'id' => 74,
                'namabarang' => 'Surat Pernyataan Debitur Perusahaan',
                'created_at' => '2024-10-17 09:24:14',
                'updated_at' => '2024-10-17 09:24:14',
            ],
            [
                'id' => 75,
                'namabarang' => 'Surat Pernyataan Kredit Dengan Jaminan Sertifikasi Pendidik',
                'created_at' => '2024-10-17 09:27:40',
                'updated_at' => '2024-10-17 09:27:40',
            ],
            [
                'id' => 76,
                'namabarang' => 'Surat Pernyataan',
                'created_at' => '2024-10-17 09:27:56',
                'updated_at' => '2024-10-17 09:27:56',
            ],
            [
                'id' => 77,
                'namabarang' => 'Surat Pernyataan Persetujuan Dan Ikut Bertanggung Jawab Suami/Istri/Orang Tua',
                'created_at' => '2024-10-17 09:28:32',
                'updated_at' => '2024-10-17 09:28:32',
            ],
            [
                'id' => 78,
                'namabarang' => 'Surat Pernyataan Tidak Menggandakan Buku Tabungan Dan Kartu Atm Kredit Jaminan Sertifikasi Pendidik',
                'created_at' => '2024-10-17 09:28:55',
                'updated_at' => '2024-10-17 09:28:55',
            ],
            [
                'id' => 79,
                'namabarang' => 'Surat Persetujuan Permintaan Informasi Debitur',
                'created_at' => '2024-10-17 09:29:19',
                'updated_at' => '2024-10-17 09:29:19',
            ],
            [
                'id' => 80,
                'namabarang' => 'Surat Substitusi Pemotongan Gaji Karyawan Perusahaan',
                'created_at' => '2024-10-17 09:29:34',
                'updated_at' => '2024-10-17 09:29:34',
            ],
            [
                'id' => 81,
                'namabarang' => 'Surat Pernyataan Tidak Melakukan Transaksi M-Banking',
                'created_at' => '2024-10-17 09:29:52',
                'updated_at' => '2024-10-17 09:29:52',
            ],
            [
                'id' => 82,
                'namabarang' => 'Verifikasi Data',
                'created_at' => '2024-10-17 09:30:04',
                'updated_at' => '2024-10-17 09:30:04',
            ],
            [
                'id' => 83,
                'namabarang' => 'Slip Penyetoran',
                'created_at' => '2024-11-22 12:56:30',
                'updated_at' => '2024-11-22 12:56:30',
            ],
        ]);
    }
}
