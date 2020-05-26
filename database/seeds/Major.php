<?php

use Illuminate\Database\Seeder;
use App\Major as Majors;

class Major extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrMajors = [
            ['FEBD301', 'D3 Perbankan dan Keuangan'],
            ['FEBD302', 'D3 Akuntansi'],
            ['FEBS101', 'S1 Manajemen'],
            ['FEBS102', 'S1 Akuntansi'],
            ['FEBS103', 'S1 Ekonomi Pembangunan'],
            ['FEBS104', 'S1 Ekonomi Syariah'],
            ['FEBS201', 'S2 Manajemen'],
            ['FKS101', 'S1 Kedokteran'],
            ['FKPROF', 'Pendidikan Profesi Ners'],
            ['FTS101', 'S1 Teknik Mesin'],
            ['FTS102', 'S1 Teknik Industri'],
            ['FTS103', 'S1 Teknik Perkapalan'],
            ['FISIPS101', 'S1 Ilmu Komunikasi'],
            ['FISIPS102', 'S1 Hubungan Internasional'],
            ['FISIPS103', 'S1 Ilmu Politik'],
            ['FIKD301', 'D3 Sistem Informasi'],
            ['FIKS101', 'S1 Sistem Informasi'],
            ['FIKS102', 'S1 Informatika'],
            ['FHS101', 'S1 Hukum'],
            ['FHS201', 'S2 Hukum'],
            ['FIKESD301', 'D3 Keperawatan'],
            ['FIKESD302', 'D3 Fisioterapi'],
            ['FIKESS101', 'S1 Keperawatan'],
            ['FIKESS102', 'S1 Kesehatan Masyarakat'],
            ['FIKESS103', 'S1 Gizi'],
            ['FIKESPROF', 'Pendidikan Profesi Ners'],
        ];
        for ($i = 0; $i < count($arrMajors); $i++) {
            if ($i <= 6) {
                $faculty_id = 1;
            } else if ($i > 6 && $i <= 8) {
                $faculty_id = 2;
            } else if ($i > 8 && $i <= 11) {
                $faculty_id = 3;
            } else if ($i > 11 && $i <= 14) {
                $faculty_id = 4;
            } else if ($i > 14 && $i <= 17) { 
                $faculty_id = 5;
            } else if ($i > 17 && $i <= 19) {
                $faculty_id = 6;
            } else if ($i > 19 && $i <= 24) {
                $faculty_id = 7;
            }
            Majors::create([
                'major_code'   => $arrMajors[$i][0],
                'name'         => $arrMajors[$i][1],
                'faculty_id'   => $faculty_id
            ]);
        }
    }
}
