<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Personality;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\PersonalityController
 */
final class PersonalityControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $personalities = Personality::factory()->count(3)->create();

        $response = $this->get(route('personalities.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PersonalityController::class,
            'store',
            \App\Http\Requests\Api\PersonalityStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();
        $birthdate = Carbon::parse($this->faker->date());
        $description = $this->faker->text();
        $created_by = $this->faker->randomNumber();
        $user = User::factory()->create();

        $response = $this->post(route('personalities.store'), [
            'name' => $name,
            'birthdate' => $birthdate->toDateString(),
            'description' => $description,
            'created_by' => $created_by,
            'user_id' => $user->id,
        ]);

        $personalities = Personality::query()
            ->where('name', $name)
            ->where('birthdate', $birthdate)
            ->where('description', $description)
            ->where('created_by', $created_by)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $personalities);
        $personality = $personalities->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $personality = Personality::factory()->create();

        $response = $this->get(route('personalities.show', $personality));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\PersonalityController::class,
            'update',
            \App\Http\Requests\Api\PersonalityUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $personality = Personality::factory()->create();
        $name = $this->faker->name();
        $birthdate = Carbon::parse($this->faker->date());
        $description = $this->faker->text();
        $created_by = $this->faker->randomNumber();
        $user = User::factory()->create();

        $response = $this->put(route('personalities.update', $personality), [
            'name' => $name,
            'birthdate' => $birthdate->toDateString(),
            'description' => $description,
            'created_by' => $created_by,
            'user_id' => $user->id,
        ]);

        $personality->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $personality->name);
        $this->assertEquals($birthdate, $personality->birthdate);
        $this->assertEquals($description, $personality->description);
        $this->assertEquals($created_by, $personality->created_by);
        $this->assertEquals($user->id, $personality->user_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $personality = Personality::factory()->create();

        $response = $this->delete(route('personalities.destroy', $personality));

        $response->assertNoContent();

        $this->assertModelMissing($personality);
    }
}
