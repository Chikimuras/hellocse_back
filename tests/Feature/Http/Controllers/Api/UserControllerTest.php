<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\UserController
 */
final class UserControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $users = User::factory()->count(3)->create();

        $response = $this->get(route('users.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\UserController::class,
            'store',
            \App\Http\Requests\Api\UserStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();
        $email = $this->faker->safeEmail();
        $password = $this->faker->password();
        $remember_token = $this->faker->uuid();

        $response = $this->post(route('users.store'), [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'remember_token' => $remember_token,
        ]);

        $users = User::query()
            ->where('name', $name)
            ->where('email', $email)
            ->where('password', $password)
            ->where('remember_token', $remember_token)
            ->get();
        $this->assertCount(1, $users);
        $user = $users->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.show', $user));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Api\UserController::class,
            'update',
            \App\Http\Requests\Api\UserUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $user = User::factory()->create();
        $name = $this->faker->name();
        $email = $this->faker->safeEmail();
        $password = $this->faker->password();
        $remember_token = $this->faker->uuid();

        $response = $this->put(route('users.update', $user), [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'remember_token' => $remember_token,
        ]);

        $user->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
        $this->assertEquals($password, $user->password);
        $this->assertEquals($remember_token, $user->remember_token);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', $user));

        $response->assertNoContent();

        $this->assertModelMissing($user);
    }
}
