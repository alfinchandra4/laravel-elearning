<?php

use Illuminate\Database\Seeder;
use App\Faculty as Fac;

class Faculty extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arrFaculty = [
            ['FEB', 'Ekonomi dan Bisnis'],
            ['FK', 'Kedokteran'],
            ['FT', 'Teknik'],
            ['FISIP', 'Ilmu Sosial'],
            ['FIK', 'Ilmu Komputer'],
            ['FH', 'Hukum'],
            ['FIKES', 'Ilmu Kesehatan']
        ];
        for ($i = 0; $i < count($arrFaculty); $i++) {
            Fac::create([
                'faculty_code' => $arrFaculty[$i][0],
                'name'         => $arrFaculty[$i][1]
            ]);
        }
        // 00, 
        // 01, 
        // 10, 
        // 11


    }
}
