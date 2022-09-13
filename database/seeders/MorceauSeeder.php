<?php

namespace Database\Seeders;

use App\Models\Morceau;
use Illuminate\Database\Seeder;

class MorceauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Morceau::factory()->count(30)->create();
    }
}
