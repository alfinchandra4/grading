<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LqQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Pengembangan kompetensi
            ['question' => 'Kebutuhan untuk studi lanjut','lq_category_id' => 1],
            ['question' => 'Pengembangan diri untuk mengikuti kursus/pelatihan','lq_category_id' => 1],
            ['question' => 'Pengembangan diri mengikuti seminar/workshop','lq_category_id' => 1],
            ['question' => 'Pengembangan diri mengikuti magang', 'lq_category_id' => 1],
            ['question' => 'Kesempatan untuk mengikuti studi banding dalam negeri', 'lq_category_id' => 1],
            ['question' => 'Kesempatan untuk mengikuti studi banding luar negeri', 'lq_category_id' => 1],

            // Pengembangan karir / jabatan
            ['question' => 'Mendapatkan informasi tentang jenjang karir', 'lq_category_id' => 2],
            ['question' => 'Mendapatkan layanan tentang jenjang karir', 'lq_category_id' => 2],
            ['question' => 'Memproleh kesempatan untuk peningkata jenjang karir', 'lq_category_id' => 2],
            ['question' => 'Mendapatkan informasi tentang jabatan', 'lq_category_id' => 2],
            ['question' => 'Mendapatkan layanan tentang jabatan', 'lq_category_id' => 2],
            ['question' => 'Memproleh kesempatan untuk peningkatan jabatan struktural', 'lq_category_id' => 2],
            ['question' => 'Memproleh kesempatan untuk peningkatan jabatan nonstruktural', 'lq_category_id' => 2],

            // Penelitian dan Karya Ilmiah
            ['question' => 'Fasilitas memperoleh informasi tentang kegiatan penelitian', 'lq_category_id' => 3],
            ['question' => 'Fasilitas memperoleh pelayanan untuk melakukan kegiatan penelitian', 'lq_category_id' => 3],
            ['question' => 'Ketersediaan sarana prasarana pendukung kegiatan penelitian', 'lq_category_id' => 3],
            ['question' => 'Memperoleh penilaian proposal penelitian dari reviewer', 'lq_category_id' => 3],
            ['question' => 'Memperoleh pemerataan penelitian berdasarkan distribusi dosen', 'lq_category_id' => 3],
            ['question' => 'Memperoleh pemerataan penelitian berdasarkan kualifikasi dosen', 'lq_category_id' => 3],
            ['question' => 'Memperoleh kesempatan bimbingan penyusunan proposal penelitian dan laporan akhir', 'lq_category_id' => 3],
            ['question' => 'Kesempatan menjadi reviewer penelitian', 'lq_category_id' => 3],
            ['question' => 'Ketersediaan informasi jurnal terakreditasi sebagai media publikasi karya ilmiah', 'lq_category_id' => 3],

            // Pengabdian kepada masyarakat
            ['question' => 'Fasilitas memperoleh informasi tentang kegiatan pengabdian kepada masyarakat.', 'lq_category_id' => 4],
            ['question' => 'Fasilitas memperoleh pelayanan untuk melakukan kegiatan pengabdian kepada masyarakat.', 'lq_category_id' => 4],
            ['question' => 'Ketersediaan sarana prasarana pendukung kegiatan pengabdian kepada masyarakat.', 'lq_category_id' => 4],
            ['question' => 'Memperoleh penilaian proposal pengabdian kepada masyarakat dari reviewer', 'lq_category_id' => 4],
            ['question' => 'Memperoleh pemerataan pengabdian kepada masyarakat berdasarkan distribusi dosen', 'lq_category_id' => 4],
            ['question' => 'Memperoleh pemerataan pengabdian kepada masyarakat berdasarkan kualifikasi dosen', 'lq_category_id' => 4],
            ['question' => 'Memperoleh kesempatan bimbingan penyusunan proposal pengabdian kepada masyarakat dan laporanakhir', 'lq_category_id' => 4],

            // Tugas Tambahan
            ['question' => 'Mendapatkan informasi tentang tugas tambahan (kepanitiaan, narasumber, keanggotaan suatu unit, dan lain-lain)', 'lq_category_id' => 5],
            ['question' => 'Mendapatkan kesempatan dalam tugas tambahan', 'lq_category_id' => 5],
            ['question' => 'Memperoleh pemerataan dalam mendapatkan tugas tambahan', 'lq_category_id' => 5],
            ['question' => 'Kesempatan untuk mewakili menjadi utusan badan normatif ditingkat fakultas', 'lq_category_id' => 5],
            ['question' => 'Kesempatan untuk mewakili menjadi utusan badan normatif di tingkat universitas', 'lq_category_id' => 5],
            ['question' => 'Mendapatkan tugas tambahan mengajar di luar home base', 'lq_category_id' => 5],

            // Kebutuhan Kesejahteraan
            ['question' => 'Memperoleh informasi tentang berbagai fasilitas kesejahteraan (seperti: mess, kendaraan dan lain-lain).', 'lq_category_id' => 6],
            ['question' => 'Memperoleh layanan penggunaan fasilitas pendukung untuk rekreasi seperti Mess dan mobil/bus universitas', 'lq_category_id' => 6],
            ['question' => 'Pemberian penghargaan atas prestasi kerja yang baik', 'lq_category_id' => 6],

            // Kebutuhan Kesehatan dan Kebugaran
            ['question' => 'Memperoleh informasi tentang layanan kesehatan', 'lq_category_id' => 7],
            ['question' => 'Memperoleh layanan pemeriksaan kesehatan oleh dokter melalui poliklinik universitas', 'lq_category_id' => 7],
            ['question' => 'Memperoleh layanan peningkatan kebugaran jasmani melalui sarana prasarana olahraga', 'lq_category_id' => 7],
            
            // Kebutuhan Sosial/Keagamaan
            ['question' => 'Memperoleh layanan kebutuhan sosial', 'lq_category_id' => 8],
            ['question' => 'Menggunakan fasilitas untuk melakukan ibadah', 'lq_category_id' => 8],
            ['question' => 'Memperoleh layanan kematian seperti mobil jenazah', 'lq_category_id' => 8],
            
        ];

        DB::table('lq_questions')->insert($data);
    }
}
