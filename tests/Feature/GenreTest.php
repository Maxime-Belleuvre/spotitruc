<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Genre;

class GenreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_storeGenreHasError()
    {
        $genre = Genre::create([
            'genre' => 'Raps'
        ]);

        $genre->assertSessionHasNoErrors();
        
        $genre2 = Genre::create([
            'genre' => 'Raps'
        ]);

        
        $genre2->assertSessionHasErrors();

    }
}
