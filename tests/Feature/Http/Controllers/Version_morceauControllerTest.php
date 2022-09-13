<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\VersionMorceau;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Version_morceauController
 */
class Version_morceauControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $versionMorceaus = Version_morceau::factory()->count(3)->create();

        $response = $this->get(route('version_morceau.index'));

        $response->assertOk();
        $response->assertViewIs('versionMorceau.index');
        $response->assertViewHas('versionMorceaus');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('version_morceau.create'));

        $response->assertOk();
        $response->assertViewIs('versionMorceau.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Version_morceauController::class,
            'store',
            \App\Http\Requests\Version_morceauStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $response = $this->post(route('version_morceau.store'));

        $response->assertRedirect(route('versionMorceau.index'));
        $response->assertSessionHas('versionMorceau.id', $versionMorceau->id);

        $this->assertDatabaseHas(versionMorceaus, [ /* ... */ ]);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $versionMorceau = Version_morceau::factory()->create();

        $response = $this->get(route('version_morceau.show', $versionMorceau));

        $response->assertOk();
        $response->assertViewIs('versionMorceau.show');
        $response->assertViewHas('versionMorceau');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $versionMorceau = Version_morceau::factory()->create();

        $response = $this->get(route('version_morceau.edit', $versionMorceau));

        $response->assertOk();
        $response->assertViewIs('versionMorceau.edit');
        $response->assertViewHas('versionMorceau');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Version_morceauController::class,
            'update',
            \App\Http\Requests\Version_morceauUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $versionMorceau = Version_morceau::factory()->create();

        $response = $this->put(route('version_morceau.update', $versionMorceau));

        $versionMorceau->refresh();

        $response->assertRedirect(route('versionMorceau.index'));
        $response->assertSessionHas('versionMorceau.id', $versionMorceau->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $versionMorceau = Version_morceau::factory()->create();
        $versionMorceau = VersionMorceau::factory()->create();

        $response = $this->delete(route('version_morceau.destroy', $versionMorceau));

        $response->assertRedirect(route('versionMorceau.index'));

        $this->assertModelMissing($versionMorceau);
    }
}
