<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Groupe;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GroupeController
 */
class GroupeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $groupes = Groupe::factory()->count(3)->create();

        $response = $this->get(route('groupe.index'));

        $response->assertOk();
        $response->assertViewIs('groupe.index');
        $response->assertViewHas('groupes');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('groupe.create'));

        $response->assertOk();
        $response->assertViewIs('groupe.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GroupeController::class,
            'store',
            \App\Http\Requests\GroupeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $nom = $this->faker->word;
        $nationalite = $this->faker->word;
        $date_creation = $this->faker->date();

        $response = $this->post(route('groupe.store'), [
            'nom' => $nom,
            'nationalite' => $nationalite,
            'date_creation' => $date_creation,
        ]);

        $groupes = Groupe::query()
            ->where('nom', $nom)
            ->where('nationalite', $nationalite)
            ->where('date_creation', $date_creation)
            ->get();
        $this->assertCount(1, $groupes);
        $groupe = $groupes->first();

        $response->assertRedirect(route('groupe.index'));
        $response->assertSessionHas('groupe.id', $groupe->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $groupe = Groupe::factory()->create();

        $response = $this->get(route('groupe.show', $groupe));

        $response->assertOk();
        $response->assertViewIs('groupe.show');
        $response->assertViewHas('groupe');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $groupe = Groupe::factory()->create();

        $response = $this->get(route('groupe.edit', $groupe));

        $response->assertOk();
        $response->assertViewIs('groupe.edit');
        $response->assertViewHas('groupe');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GroupeController::class,
            'update',
            \App\Http\Requests\GroupeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $groupe = Groupe::factory()->create();
        $nom = $this->faker->word;
        $nationalite = $this->faker->word;
        $date_creation = $this->faker->date();

        $response = $this->put(route('groupe.update', $groupe), [
            'nom' => $nom,
            'nationalite' => $nationalite,
            'date_creation' => $date_creation,
        ]);

        $groupe->refresh();

        $response->assertRedirect(route('groupe.index'));
        $response->assertSessionHas('groupe.id', $groupe->id);

        $this->assertEquals($nom, $groupe->nom);
        $this->assertEquals($nationalite, $groupe->nationalite);
        $this->assertEquals(Carbon::parse($date_creation), $groupe->date_creation);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $groupe = Groupe::factory()->create();

        $response = $this->delete(route('groupe.destroy', $groupe));

        $response->assertRedirect(route('groupe.index'));

        $this->assertModelMissing($groupe);
    }
}
