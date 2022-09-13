<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Morceau;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MorceauController
 */
class MorceauControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $morceaus = Morceau::factory()->count(3)->create();

        $response = $this->get(route('morceau.index'));

        $response->assertOk();
        $response->assertViewIs('morceau.index');
        $response->assertViewHas('morceaus');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('morceau.create'));

        $response->assertOk();
        $response->assertViewIs('morceau.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MorceauController::class,
            'store',
            \App\Http\Requests\MorceauStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $titre = $this->faker->word;

        $response = $this->post(route('morceau.store'), [
            'titre' => $titre,
        ]);

        $morceaus = Morceau::query()
            ->where('titre', $titre)
            ->get();
        $this->assertCount(1, $morceaus);
        $morceau = $morceaus->first();

        $response->assertRedirect(route('morceau.index'));
        $response->assertSessionHas('morceau.id', $morceau->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $morceau = Morceau::factory()->create();

        $response = $this->get(route('morceau.show', $morceau));

        $response->assertOk();
        $response->assertViewIs('morceau.show');
        $response->assertViewHas('morceau');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $morceau = Morceau::factory()->create();

        $response = $this->get(route('morceau.edit', $morceau));

        $response->assertOk();
        $response->assertViewIs('morceau.edit');
        $response->assertViewHas('morceau');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MorceauController::class,
            'update',
            \App\Http\Requests\MorceauUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $morceau = Morceau::factory()->create();
        $titre = $this->faker->word;

        $response = $this->put(route('morceau.update', $morceau), [
            'titre' => $titre,
        ]);

        $morceau->refresh();

        $response->assertRedirect(route('morceau.index'));
        $response->assertSessionHas('morceau.id', $morceau->id);

        $this->assertEquals($titre, $morceau->titre);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $morceau = Morceau::factory()->create();

        $response = $this->delete(route('morceau.destroy', $morceau));

        $response->assertRedirect(route('morceau.index'));

        $this->assertModelMissing($morceau);
    }
}
