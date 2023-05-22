<?php

namespace Database\Seeders;

use App\Models\Ring;
use Illuminate\Database\Seeder;

class AnnualWheelRingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rings =
            [
                [
                    'name' => 'Finance',
                    'color_code' => ' #EFF1FB',
                ],
                [
                    'name' => 'Product',
                    'color_code' => ' #DFE2F5',
                ],
                [
                    'name' => 'Technology',
                    'color_code' => ' #D0D4EF',
                ],
                [
                    'name' => 'Management',
                    'color_code' => ' #BABFE4',
                ]];
        foreach ($rings as $ring) {
            Ring::create($ring);
        }
    }
}
