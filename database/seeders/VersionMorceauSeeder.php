<?php

namespace Database\Seeders;

use App\Models\VersionMorceau;
use Illuminate\Database\Seeder;

class VersionMorceauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VersionMorceau::factory()->count(5)->create();
    }
}
