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

            [ 'question' => 'Integritas (etika dan moral)', 'aq_category_id' => 1 ],
            [ 'question' => 'Keahlian pada bidang ilmu (kompetensi utama)', 'aq_category_id' => 1 ],
            [ 'question' => 'Keluasan wawasan antardisiplin ilmu', 'aq_category_id' => 1 ],
            [ 'question' => 'Kepemimpinan', 'aq_category_id' => 1 ],
            [ 'question' => 'Kerja sama dalam tim', 'aq_category_id' => 1 ],
            [ 'question' => 'Kemampuan berbahasa asing', 'aq_category_id' => 1 ],
            [ 'question' => 'Kemampuan berkomunikasi', 'aq_category_id' => 1 ],
            [ 'question' => 'Penggunaan teknologi informasi', 'aq_category_id' => 1 ],
            [ 'question' => 'Pengembangan diri', 'aq_category_id' => 1 ],

            [ 'question' => 'Kemampuan dan kerja lulusan Fakultas Ilmu Komputer UPN “Veteran” Jakarta di tempat kerja', 'aq_category_id' => 2 ],
            [ 'question' => 'Kemandirian lulusan Fakultas Ilmu Komputer UPN “Veteran” Jakarta', 'aq_category_id' => 2 ],
            [ 'question' => 'Kompetensi lulusan UPN “Veteran” Jakarta untuk bersaing di dunia usaha maupun dunia industri saat ini', 'aq_category_id' => 2 ],
            [ 'question' => 'Kualitas UPN “Veteran” Jakarta dalam meningkatkan kemampuan, keterampilan dan kemandirian alumni Fakultas Ilmu Komputer UPN “Veteran” Jakarta', 'aq_category_id' => 2 ],

            [ 'question' => 'Perencanaan, pengembangan dan pembangunan teknologi informasi dan komunikasi yang dialami dunia usaha dan dunia industri pada masa lalu', 'aq_category_id' => 3 ],
            [ 'question' => 'Pengetahuan tentang perencanaan, pengembangan dan pembangunan teknologi informasi dan komunikasi dunia usaha dan dunia industri', 'aq_category_id' => 3 ],
            [ 'question' => 'Kemampuan menerapkan teori perencanaan, pengembangan dan pembangunan teknologi informasi dan komunikasi dalam kasus yang dihadapi.', 'aq_category_id' => 3 ],
            [ 'question' => 'Kemampuan dalam melakukan identifikasi permasalahan dan pemecahan permasalahan melalui data-data yang akurat', 'aq_category_id' => 3 ],
            [ 'question' => 'Kemampuan dalam membuat konsep perencanaan, pengembangan dan pembangunan teknologi informasi dan komunikasi.', 'aq_category_id' => 3 ],

        ];

        DB::table('aq_questions')->insert($data);

    }
}
