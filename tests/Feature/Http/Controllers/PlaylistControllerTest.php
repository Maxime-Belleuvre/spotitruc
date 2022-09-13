<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PlaylistController
 */
class PlaylistControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $playlists = Playlist::factory()->count(3)->create();

        $response = $this->get(route('playlist.index'));

        $response->assertOk();
        $response->assertViewIs('playlist.index');
        $response->assertViewHas('playlists');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('playlist.create'));

        $response->assertOk();
        $response->assertViewIs('playlist.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlaylistController::class,
            'store',
            \App\Http\Requests\PlaylistStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $intitule = $this->faker->word;
        $description = $this->faker->text;
        $user = User::factory()->create();

        $response = $this->post(route('playlist.store'), [
            'intitule' => $intitule,
            'description' => $description,
            'user_id' => $user->id,
        ]);

        $playlists = Playlist::query()
            ->where('intitule', $intitule)
            ->where('description', $description)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $playlists);
        $playlist = $playlists->first();

        $response->assertRedirect(route('playlist.index'));
        $response->assertSessionHas('playlist.id', $playlist->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $playlist = Playlist::factory()->create();

        $response = $this->get(route('playlist.show', $playlist));

        $response->assertOk();
        $response->assertViewIs('playlist.show');
        $response->assertViewHas('playlist');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $playlist = Playlist::factory()->create();

        $response = $this->get(route('playlist.edit', $playlist));

        $response->assertOk();
        $response->assertViewIs('playlist.edit');
        $response->assertViewHas('playlist');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlaylistController::class,
            'update',
            \App\Http\Requests\PlaylistUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $playlist = Playlist::factory()->create();
        $intitule = $this->faker->word;
        $description = $this->faker->text;
        $user = User::factory()->create();

        $response = $this->put(route('playlist.update', $playlist), [
            'intitule' => $intitule,
            'description' => $description,
            'user_id' => $user->id,
        ]);

        $playlist->refresh();

        $response->assertRedirect(route('playlist.index'));
        $response->assertSessionHas('playlist.id', $playlist->id);

        $this->assertEquals($intitule, $playlist->intitule);
        $this->assertEquals($description, $playlist->description);
        $this->assertEquals($user->id, $playlist->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $playlist = Playlist::factory()->create();

        $response = $this->delete(route('playlist.destroy', $playlist));

        $response->assertRedirect(route('playlist.index'));

        $this->assertModelMissing($playlist);
    }
}
