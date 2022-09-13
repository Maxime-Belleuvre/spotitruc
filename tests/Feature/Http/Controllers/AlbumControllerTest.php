<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Album;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AlbumController
 */
class AlbumControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $albums = Album::factory()->count(3)->create();

        $response = $this->get(route('album.index'));

        $response->assertOk();
        $response->assertViewIs('album.index');
        $response->assertViewHas('albums');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('album.create'));

        $response->assertOk();
        $response->assertViewIs('album.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AlbumController::class,
            'store',
            \App\Http\Requests\AlbumStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $titre = $this->faker->word;
        $annee = $this->faker->date();

        $response = $this->post(route('album.store'), [
            'titre' => $titre,
            'annee' => $annee,
        ]);

        $albums = Album::query()
            ->where('titre', $titre)
            ->where('annee', $annee)
            ->get();
        $this->assertCount(1, $albums);
        $album = $albums->first();

        $response->assertRedirect(route('album.index'));
        $response->assertSessionHas('album.id', $album->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $album = Album::factory()->create();

        $response = $this->get(route('album.show', $album));

        $response->assertOk();
        $response->assertViewIs('album.show');
        $response->assertViewHas('album');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $album = Album::factory()->create();

        $response = $this->get(route('album.edit', $album));

        $response->assertOk();
        $response->assertViewIs('album.edit');
        $response->assertViewHas('album');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AlbumController::class,
            'update',
            \App\Http\Requests\AlbumUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $album = Album::factory()->create();
        $titre = $this->faker->word;
        $annee = $this->faker->date();

        $response = $this->put(route('album.update', $album), [
            'titre' => $titre,
            'annee' => $annee,
        ]);

        $album->refresh();

        $response->assertRedirect(route('album.index'));
        $response->assertSessionHas('album.id', $album->id);

        $this->assertEquals($titre, $album->titre);
        $this->assertEquals(Carbon::parse($annee), $album->annee);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $album = Album::factory()->create();

        $response = $this->delete(route('album.destroy', $album));

        $response->assertRedirect(route('album.index'));

        $this->assertModelMissing($album);
    }
}
