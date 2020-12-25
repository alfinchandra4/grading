<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SqCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [ 
            ['category' => 'Tangibles'], 
            ['category' => 'Reliability'], 
            ['category' => 'Responsiveness'],
            ['category' =>  'Assurance'], 
            ['category' => 'Empathy']
        ];
        DB::table('sq_categories')->insert($data);
    }
}
