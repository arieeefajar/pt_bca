<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailKuisioner;
use Carbon\Carbon;

class DetailKuisionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['pertanyaan' => 'Siapa saja pesaing perusahaan ?', 'jenis_jawaban' => '3', 'jenis_quisioner_id' => 1],
            ['pertanyaan' => 'Siapa saja pendatang baru yang dapat mengancam perusahaan ?', 'jenis_jawaban' => '3', 'jenis_quisioner_id' => 1],
            ['pertanyaan' => 'Siapa saja pembuat produk (produsen) substitusi pengganti produk perusahaan ?', 'jenis_jawaban' => '3', 'jenis_quisioner_id' => 1],
            ['pertanyaan' => 'Siapa saja pemasok perusahaan ?', 'jenis_jawaban' => '3', 'jenis_quisioner_id' => 1],
            ['pertanyaan' => 'Siapa saja pembeli perusahaan ?', 'jenis_jawaban' => '3', 'jenis_quisioner_id' => 1],

            ['pertanyaan' => 'Apakah terdapat banyak pesaing di dalam pasar ? ', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 2],
            ['pertanyaan' => 'Apakah produk perusahaan dapat dibedakan dengan produk-produk pesaing ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 2],
            ['pertanyaan' => 'Apakah tiap-tiap perusahaan dapat dengan mudah keluar dari persaingan pasar ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 2],

            ['pertanyaan' => ' Apakah diperlukan produksi dalam jumlah besar untuk mencapai skala ekonomis ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 3],
            ['pertanyaan' => 'Apakah produk perusahaan dapat dibedakan dengan jelas dibanding produk pesaing ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 3],
            ['pertanyaan' => 'Apakah diperlukan modal besar untuk memulai bisnis dalam industri ini ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 3],
            ['pertanyaan' => 'Apakah perusahaan mempunyai keunggulan biaya yang tidak tergantung ukuran produksi dibandingkan pendatang baru ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 3],
            ['pertanyaan' => 'Apakah pendatang baru dapat dengan mudah memakai saluran distribusi yang telah ada ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 3],
            ['pertanyaan' => 'Apakah kebijakan pemerintah memudahkan pendatang baru untuk masuk ke dalam industri ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 3],

            ['pertanyaan' => 'Apakah pembeli dapat dengan mudah menemukan barang substitusi yang dapat menggantikan fungsi dari produk perusahaan di dalam pasar ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 4],
            ['pertanyaan' => 'Jika ya, apakah harga produk substitusi tersebut bersaing dengan produk perusahaan ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 4],

            ['pertanyaan' => 'Apakah perusahaan memiliki banyak pilihan dalam menentukan pemasok ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 5],
            ['pertanyaan' => 'Apakah perusahaan bebas untuk berganti pemasok tanpa konsekuensi tertentu, seperti biaya perggantian, harga dan kualitas ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 5],
            ['pertanyaan' => 'Apakah terdapat barang substitusi tertentu bagi perusahaan selain produk pemasok ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 5],
            ['pertanyaan' => 'Apakah ada kecenderungan bagi pemasok untuk bersaing secara langsung dengan cara masuk ke dalam industri ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 5],
            ['pertanyaan' => 'Apakah perusahaan dan/atau industrinya adalah kelompok pembeli dominan bagi kelompok pemasok ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 5],

            ['pertanyaan' => 'Apakah tiap pembeli memberikan kontribusi yang besar terhadap total penjualan perusahaan ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 6],
            ['pertanyaan' => 'Apakah produk yang diinginkan oleh calon pembeli tidak berbeda jauh di antara pesaing-pesaing di dalam industri perusahaan ? ', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 6],
            ['pertanyaan' => 'Apakah pembeli dapat dengan mudah berganti penjual tanpa konsekuensi tertentu seperti harga dan kualitas ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 6],
            ['pertanyaan' => 'Apakah pembeli dapat dengan mudah berganti penjual tanpa konsekuensi tertentu seperti harga dan kualitas ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 6],
            ['pertanyaan' => 'Apakah calon pembeli lebih mementingkan kualitas daripada 
            harga dalam pembelian ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 6],
            ['pertanyaan' => 'Apakah ada kecenderungan bagi pembeli masuk ke dalam industri perusahaan untuk bersaing langsung ?', 'jenis_jawaban' => '2', 'jenis_quisioner_id' => 6],

            ['pertanyaan' => 'Kedudukan produk pesaing (dari sudut pandang pengguna) di setiap segmen pasar', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 7],
            ['pertanyaan' => 'Luas dan dalamnya lini produk pesaing', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 7],

            ['pertanyaan' => 'Kualitas saluran distribusi pesaing', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 8],
            ['pertanyaan' => 'Kekuatan hubungan saluran distribusi yang dimiliki pesaing', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 8],
            ['pertanyaan' => 'Kemampuan pesaing untuk melayani saluran distribusi', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 8],

            ['pertanyaan' => 'Keterampilan pesaing pada masing-masing aspek bauran pemasaran', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 9],
            ['pertanyaan' => 'Keterampilan pesaing dalam pengembangan produk baru', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 9],

            ['pertanyaan' => 'Kecanggihan teknologi dari fasilitas dan peralatan yang dimiliki pesaing', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 10],
            ['pertanyaan' => 'Fleksibilitas fasilitas dan peralatan yang dimiliki pesaing', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 10],
            ['pertanyaan' => 'Keterampilan pesaing dalam penambahan kapasitas, pengendalian kualitas, penggunaan fasilitas, dan peralatan', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 10],
            ['pertanyaan' => 'Akses dan biaya bahan baku yang dialokasikan pesaing', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 10],

            ['pertanyaan' => ' Paten dan hak cipta yang dimiliki pesaing', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 11],
            ['pertanyaan' => 'Kemampuan internal perusahaan pesaing dalam proses riset dan pengembangan', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 11],
            ['pertanyaan' => 'Keterampilan staf divisi riset dan pengembangan pesaing', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 11],
            ['pertanyaan' => 'Akses pesaing ke sumber-sumber eksternal perusahaan untuk penguatan riset dan pengembangan', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 11],

            ['pertanyaan' => 'Arus kas pesaing', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 12],
            ['pertanyaan' => 'Kapasitas modal baru yang dimiliki pesaing untuk bisnis masa depan', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 12],
            ['pertanyaan' => 'Kemampuan manajemen keuangan pesaing, termasuk negosiasi, mendapatkan modal, kredit, persediaan, serta piutang', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 12],

            ['pertanyaan' => 'Keseragaman nilai dan kejelasan misi dan tujuan organisasi pesaing', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 13],
            ['pertanyaan' => 'Konsistensi struktur organisasi dengan strategi bisnis pesaing', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 13],

            ['pertanyaan' => 'Kualitas kepemimpinan CEO pesaing - kemampuan Direktur Utama untuk memotivasi', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 14],
            ['pertanyaan' => 'Kemampuan manajemen perusahaan pesaing untuk mengkoordinasi fungsi atau kelompok fungsi tertentu (misalnya koordinasi pengembangan produk dengan riset)', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 14],

            ['pertanyaan' => 'Kemampuan pesaing dalam bidang fungsional', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 15],
            ['pertanyaan' => 'Kemampuan pesaing mengukur konsistensi dari strateginya', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 15],
            ['pertanyaan' => 'Kapasitas pesaing dalam menanggapi gerakan pihak lain (misalnya produk baru yang belum diperkenalkan, tetapi sudah siap untuk diluncurkan)', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 15],
            ['pertanyaan' => 'Kemampuan pesaing dalam menyesuaikan diri dan merespon kondisi yang berubah di setiap bidang fungsional (misalnya menyesuaikan diri untuk bersaing dalam harga, mengelola lini 
            produk yang lebih kompleks, menambah produk baru, bersaing dalam layanan, meningkatkan kegiatan pemasaran)', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 15],
            ['pertanyaan' => 'Kemampuan pesaing untuk bertahan dari perang persaingan yang berkepanjangan, yang mungkin akan menekan laba dan arus kas', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 15],

            ['pertanyaan' => 'Kemampuan pesaing untuk mendukung perubahan yang terencana dalam semua unit bisnisnya dalam bentuk sumber dana dan sumber daya lain', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 16],
            ['pertanyaan' => 'Kemampuan pesaing untuk melengkapi atau memperkokoh kekuatan unit bisnisnya', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 16],

            ['pertanyaan' => 'Perlakuan khusus atau akses pesaing ke lembaga pemerintahan', 'jenis_jawaban' => '1', 'jenis_quisioner_id' => 17],
        ];
        foreach ($data as $value) {
            DetailKuisioner::insert([
                'pertanyaan' => $value['pertanyaan'],
                'jenis_jawaban' => $value['jenis_jawaban'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'jenis_quisioner_id' => $value['jenis_quisioner_id']
            ]);
        }
    }
}
