<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Artiste;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ArtisteController
 */
class ArtisteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $artistes = Artiste::factory()->count(3)->create();

        $response = $this->get(route('artiste.index'));

        $response->assertOk();
        $response->assertViewIs('artiste.index');
        $response->assertViewHas('artistes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('artiste.create'));

        $response->assertOk();
        $response->assertViewIs('artiste.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ArtisteController::class,
            'store',
            \App\Http\Requests\ArtisteStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $nom = $this->faker->word;
        $prenom = $this->faker->word;
        $date_naissance = $this->faker->word;
        $nationalite = $this->faker->word;
        $pseudo = $this->faker->word;

        $response = $this->post(route('artiste.store'), [
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $date_naissance,
            'nationalite' => $nationalite,
            'pseudo' => $pseudo,
        ]);

        $artistes = Artiste::query()
            ->where('nom', $nom)
            ->where('prenom', $prenom)
            ->where('date_naissance', $date_naissance)
            ->where('nationalite', $nationalite)
            ->where('pseudo', $pseudo)
            ->get();
        $this->assertCount(1, $artistes);
        $artiste = $artistes->first();

        $response->assertRedirect(route('artiste.index'));
        $response->assertSessionHas('artiste.id', $artiste->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $artiste = Artiste::factory()->create();

        $response = $this->get(route('artiste.show', $artiste));

        $response->assertOk();
        $response->assertViewIs('artiste.show');
        $response->assertViewHas('artiste');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $artiste = Artiste::factory()->create();

        $response = $this->get(route('artiste.edit', $artiste));

        $response->assertOk();
        $response->assertViewIs('artiste.edit');
        $response->assertViewHas('artiste');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ArtisteController::class,
            'update',
            \App\Http\Requests\ArtisteUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $artiste = Artiste::factory()->create();
        $nom = $this->faker->word;
        $prenom = $this->faker->word;
        $date_naissance = $this->faker->word;
        $nationalite = $this->faker->word;
        $pseudo = $this->faker->word;

        $response = $this->put(route('artiste.update', $artiste), [
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $date_naissance,
            'nationalite' => $nationalite,
            'pseudo' => $pseudo,
        ]);

        $artiste->refresh();

        $response->assertRedirect(route('artiste.index'));
        $response->assertSessionHas('artiste.id', $artiste->id);

        $this->assertEquals($nom, $artiste->nom);
        $this->assertEquals($prenom, $artiste->prenom);
        $this->assertEquals($date_naissance, $artiste->date_naissance);
        $this->assertEquals($nationalite, $artiste->nationalite);
        $this->assertEquals($pseudo, $artiste->pseudo);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $artiste = Artiste::factory()->create();

        $response = $this->delete(route('artiste.destroy', $artiste));

        $response->assertRedirect(route('artiste.index'));

        $this->assertModelMissing($artiste);
    }
}
