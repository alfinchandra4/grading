<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [ 
            ['category' => 'Pengembangan Kompetensi'], 
            ['category' => 'Pengembangan Karir / Jabatan'], 
            ['category' => 'Penelitian dan Karya Ilmiah'],
            ['category' => 'Pengabdian Kepada Masyarakat'], 
            ['category' => 'Tugas Tambahan'],
            ['category' => 'Kebutuhan Kesejahteraan'], 
            ['category' => 'Kebutuhan Kesehatan dan Kebugaran'], 
            ['category' => 'Pengabdian Kepada Masyarakat'], 
        ];
        DB::table('lq_categories')->insert($data);
    }
}
