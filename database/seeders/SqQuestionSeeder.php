<?php

namespace Database\Seeders;

use App\Models\SqQuestion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SqQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Tangibles [0-6]
            [ 'question' => 'Ruang kuliah yang bersih, nyaman dan rapi', 'sq_category_id' => 1 ],
            [ 'question' => 'Fakultas Ilmu Komputer menyediakan sarana pembelajaran yang memadai di ruang kuliah.', 'sq_category_id' => 1 ],
            [ 'question' => 'Fakultas Ilmu Komputer memiliki perpustakaan yang memadai', 'sq_category_id' => 1 ],
            [ 'question' => 'Fakultas Ilmu Komputer memiliki laboratorium yang relevan dengan kebutuhan kompetensi keilmuan', 'sq_category_id' => 1 ],
            [ 'question' => 'Fakultas Ilmu Komputer menyediakan buku referensi yang memadai di perpustakaan', 'sq_category_id' => 1 ],
            [ 'question' => 'Fakultas Ilmu Komputer menyediakan fasilitas kamar kecil yang bersih', 'sq_category_id' => 1 ],
            [ 'question' => 'Fakultas Ilmu Komputer memiliki fasilitas ibadah yang dapat dipergunakan oleh mahasiswa', 'sq_category_id' => 1 ],

            // Reability [7-14]
            [ 'question' => 'Dosen selalu mengulang materi perkuliahan sampai semua mahasiswa merasa jelas', 'sq_category_id' => 2 ],
            [ 'question' => 'Dosen mengalokasikan waktu untuk diskusi dan tanya jawab', 'sq_category_id' => 2 ],
            [ 'question' => 'Dosen memberi bahan ajar (suplemen) untuk melengkapi materi yang diberikan di Fakultas Ilmu Komputer', 'sq_category_id' => 2 ],
            [ 'question' => 'Dosen selalu membagikan hasil ujian dengan nilai yang obyektif', 'sq_category_id' => 2 ],
            [ 'question' => 'Dosen selalu datang tepat waktu', 'sq_category_id' => 2 ],
            [ 'question' => 'Jumlah dosen memadai (sesuai dengan bidang keahlian dan jumlahnya)', 'sq_category_id' => 2 ],
            [ 'question' => 'Dosen selalu membuat Rencana Pembelajaran Semester (RPS)', 'sq_category_id' => 2 ],
            [ 'question' => 'Staf Akademik memiliki kemampuan untuk melayani kepentingan mahasiswa', 'sq_category_id' => 2 ],

            // Responsiveness [15-20]
            [ 'question' => 'Fakultas Ilmu Komputer menyediakan dosen Pembimbing Akademi bagi mahasiswa', 'sq_category_id' => 3 ],
            [ 'question' => 'Pelaksanaan ujian (UTS dan UAS) sesuai kalender akademik yang telah ditetapkan (tepat waktu', 'sq_category_id' => 3 ],
            [ 'question' => 'Pembelajaran sesuai dengan waktu yang telah ditentukan', 'sq_category_id' => 3 ],
            [ 'question' => 'Fakultas Ilmu Komputer menyediakan bantuan (keringanan) bagi mahasiswa tidak mampu', 'sq_category_id' => 3 ],
            [ 'question' => 'Fakultas Ilmu Komputer selalu membantu mahasiswa apabila menghadapi masalah akademik', 'sq_category_id' => 3 ],
            [ 'question' => 'Fakultas Ilmu Komputer menyediakan waktu khusus untuk orang tua mahasiswa untuk konsultasi', 'sq_category_id' => 3 ],

            // Assurance [21-25]
            [ 'question' => 'Staf Akademik santun dalam melakukan pelayanan akademik', 'sq_category_id' => 4 ],
            [ 'question' => 'Permasalahan/keluhan mahasiswa selalu ditangani oleh Fakultas Ilmu Komputer melalui dosen Pembimbing Akademik', 'sq_category_id' => 4 ],
            [ 'question' => 'Setiap tugas kuliah selalu dikembalikan pada mahasiswa', 'sq_category_id' => 4 ],
            [ 'question' => 'Waktu dipergunakan secara efektif oleh dosen dalam proses pengajaran', 'sq_category_id' => 4 ],
            [ 'question' => 'Adanya sanksi bagi mahasiswa yang melanggar peraturan yang telah ditetapkan dan berlaku untuk semua mahasiswa tanpa terkecual', 'sq_category_id' => 4 ],

            // Empathy [26-31]
            [ 'question' => 'Fakultas Ilmu Komputer selalu berusaha memahami kepentingan dan kesulitan mahasiswa', 'sq_category_id' => 5 ],
            [ 'question' => 'Besarnya kontribusi biaya (sumbangan pengembangan institusi) dibicarakan dengan orang tua/wali mahasiswa', 'sq_category_id' => 5 ],
            [ 'question' => 'Fakultas Ilmu Komputer selalu memonitor terhadap kemajuan mahasiswa melalui dosen Pembimbing Akademik', 'sq_category_id' => 5 ],
            [ 'question' => 'Dosen bersedia membantu mahasiswa yang mengalami kesulitan studi', 'sq_category_id' => 5 ],
            [ 'question' => 'Dosen bersikap bersahabat kepada mahasiswa', 'sq_category_id' => 5 ],
            [ 'question' => 'Fakultas Ilmu Komputer berusaha memahami minat dan bakat mahasiswa dan berusaha untuk mengembangkannya', 'sq_category_id' => 5 ],

        ];

                DB::table('sq_questions')->insert($data);
    }
}
