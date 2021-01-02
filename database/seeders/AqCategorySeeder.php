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
            ['category' => 'Akademik dan Kemahasiswaan'], 
            ['category' => 'Keuangan'], 
            ['category' => 'Administrasi Umum'],
            ['category' => 'Program Studi'], 
            ['category' => 'Labolatorium'],
        ];
        DB::table('aq_categories')->insert($data);
    }
}
