<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [ 
            ['category' => 'Umum'], 
            ['category' => 'Mutu dan Kompetensi Lulusan'], 
            ['category' => 'Kebutuhan Stakeholder Kota'],
        ];
        DB::table('aq_categories')->insert($data);
    }
}
