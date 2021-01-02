<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AqQuestionSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            [ 'question' => 'Penjadwalan perkuliahan setiap semester', 'aq_category_id' => 1 ],
            [ 'question' => 'Penjadwalan Ujian (UTS & UAS) sesuai dengan kalender akademik', 'aq_category_id' => 1 ],
            [ 'question' => 'Pengurusan Nilai, Surat Keterangan, KHS, KRS, Surat izin sakit/cuti, dll', 'aq_category_id' => 1 ],
            [ 'question' => 'Kualitas pelayanan oleh petugas akademik', 'aq_category_id' => 1 ],

            [ 'question' => 'Kemudahan mendapatkan dan ketepatan informasi jumlah pembayaran UKT', 'aq_category_id' => 2 ],
            [ 'question' => 'Kualitas pelayanan petugas keuangan', 'aq_category_id' => 2 ],

            [ 'question' => 'Pengurusan surat-surat (Peminjaman ruangan, peralatan, Lab, dsb.)', 'aq_category_id' => 3 ],
            [ 'question' => 'Kualitas pelayanan administrasi Umum', 'aq_category_id' => 3 ],
            
            [ 'question' => 'Kemudahan mendapatkan informasi perkuliahan', 'aq_category_id' => 4 ],
            [ 'question' => 'Kemudahan dalam mengurus transkrip nilai', 'aq_category_id' => 4 ],
            [ 'question' => 'Penyelesaian keluhan atas ketidaksesuaian seperti tidak tercantumnya nama mahasiswa dalam daftar hadir dll', 'aq_category_id' => 4 ],
            [ 'question' => 'Kualitas layanan jurusan/prodi', 'aq_category_id' => 4 ],
            [ 'question' => 'Penetapan Dosen pengampu mata kuliah', 'aq_category_id' => 4 ],
            [ 'question' => 'Dukungan jurusan/prodi terhadap kegiatan (organisasi) kemahasiswaan', 'aq_category_id' => 4 ],
            [ 'question' => 'Kualitas layanan perkuliahan oleh dosen', 'aq_category_id' => 4 ],

            [ 'question' => 'Kualitas layanan laboran', 'aq_category_id' => 5 ],
            [ 'question' => 'Kelengkapan fasilitas laboratorium', 'aq_category_id' => 5 ],
            [ 'question' => 'Kenyamanan ruang laboratorium', 'aq_category_id' => 5 ],
            [ 'question' => 'Keamanan laboratorium', 'aq_category_id' => 5 ],
            [ 'question' => 'Keberfungsian alat-alat laboratorium', 'aq_category_id' => 5 ],
            [ 'question' => 'Prosedur penggunaan laboratorium untuk keperluan pendidikan, penelitian, dan kegiatan organisasi kemahasiswaan', 'aq_category_id' => 5 ],

        ];

        DB::table('aq_questions')->insert($data);

    }
}
