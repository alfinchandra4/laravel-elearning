<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Lecturer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Admin::class)->create();
        factory(Lecturer::class)->create();
        $this->call(Faculty::class);
        $this->call(Major::class);
    }
}
