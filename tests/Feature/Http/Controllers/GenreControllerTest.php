<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GenreController
 */
class GenreControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $genres = Genre::factory()->count(3)->create();

        $response = $this->get(route('genre.index'));

        $response->assertOk();
        $response->assertViewIs('genre.index');
        $response->assertViewHas('genres');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('genre.create'));

        $response->assertOk();
        $response->assertViewIs('genre.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GenreController::class,
            'store',
            \App\Http\Requests\GenreStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $genre = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->post(route('genre.store'), [
            'genre' => $genre,
        ]);

        $genres = Genre::query()
            ->where('genre', $genre)
            ->get();
        $this->assertCount(1, $genres);
        $genre = $genres->first();

        $response->assertRedirect(route('genre.index'));
        $response->assertSessionHas('genre.id', $genre->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $genre = Genre::factory()->create();

        $response = $this->get(route('genre.show', $genre));

        $response->assertOk();
        $response->assertViewIs('genre.show');
        $response->assertViewHas('genre');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $genre = Genre::factory()->create();

        $response = $this->get(route('genre.edit', $genre));

        $response->assertOk();
        $response->assertViewIs('genre.edit');
        $response->assertViewHas('genre');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GenreController::class,
            'update',
            \App\Http\Requests\GenreUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $genre = Genre::factory()->create();
        $genre = $this->faker->randomElement(/** enum_attributes **/);

        $response = $this->put(route('genre.update', $genre), [
            'genre' => $genre,
        ]);

        $genre->refresh();

        $response->assertRedirect(route('genre.index'));
        $response->assertSessionHas('genre.id', $genre->id);

        $this->assertEquals($genre, $genre->genre);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $genre = Genre::factory()->create();

        $response = $this->delete(route('genre.destroy', $genre));

        $response->assertRedirect(route('genre.index'));

        $this->assertModelMissing($genre);
    }
}
