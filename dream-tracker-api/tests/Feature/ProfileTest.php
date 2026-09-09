<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_and_update_profile(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('mobile')->plainTextToken;

        $this->withToken($token)
            ->getJson('/api/v1/profile')
            ->assertOk()
            ->assertJsonPath('data.profile.timezone', 'UTC')
            ->assertJsonPath('data.profile.onboarding_completed', false);

        $this->withToken($token)
            ->patchJson('/api/v1/profile', [
                'name' => 'Updated Name',
                'timezone' => 'Asia/Jakarta',
                'notifications_enabled' => false,
                'onboarding_completed' => true,
                'quiet_hours_start' => '22:00',
                'quiet_hours_end' => '06:00',
            ])
            ->assertOk()
            ->assertJsonPath('data.profile.name', 'Updated Name')
            ->assertJsonPath('data.profile.timezone', 'Asia/Jakarta')
            ->assertJsonPath('data.profile.notifications_enabled', false)
            ->assertJsonPath('data.profile.onboarding_completed', true);
    }

    public function test_profile_update_rejects_invalid_timezone(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('mobile')->plainTextToken;

        $this->withToken($token)
            ->patchJson('/api/v1/profile', ['timezone' => 'not-a-timezone'])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['timezone']);
    }

    public function test_profile_requires_authentication(): void
    {
        $this->getJson('/api/v1/profile')->assertUnauthorized();
        $this->patchJson('/api/v1/profile', ['name' => 'Unauthenticated'])->assertUnauthorized();
    }
}
