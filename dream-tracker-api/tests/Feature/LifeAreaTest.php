<?php

namespace Tests\Feature;

use App\Models\LifeArea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LifeAreaTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_manage_owned_life_area(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('mobile')->plainTextToken;

        $create = $this->withToken($token)->postJson('/api/v1/life-areas', [
            'name' => 'Health',
            'color' => '#1F7A68',
            'icon' => 'heart',
        ]);

        $create->assertCreated()->assertJsonPath('data.life_area.name', 'Health');
        $lifeAreaId = $create->json('data.life_area.id');

        $this->withToken($token)
            ->getJson('/api/v1/life-areas')
            ->assertOk()
            ->assertJsonCount(1, 'data');

        $this->withToken($token)
            ->patchJson("/api/v1/life-areas/{$lifeAreaId}", ['name' => 'Wellbeing'])
            ->assertOk()
            ->assertJsonPath('data.life_area.name', 'Wellbeing');

        $this->withToken($token)
            ->deleteJson("/api/v1/life-areas/{$lifeAreaId}")
            ->assertOk();

        $this->assertDatabaseMissing('life_areas', ['id' => $lifeAreaId]);
    }

    public function test_user_cannot_modify_another_users_life_area(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $lifeArea = LifeArea::create(['user_id' => $owner->id, 'name' => 'Private']);
        $token = $otherUser->createToken('mobile')->plainTextToken;

        $this->withToken($token)
            ->patchJson("/api/v1/life-areas/{$lifeArea->id}", ['name' => 'Changed'])
            ->assertNotFound();

        $this->withToken($token)
            ->deleteJson("/api/v1/life-areas/{$lifeArea->id}")
            ->assertNotFound();
    }

    public function test_default_life_area_cannot_be_deleted(): void
    {
        $user = User::factory()->create();
        $lifeArea = LifeArea::create(['user_id' => $user->id, 'name' => 'Health', 'is_default' => true]);
        $token = $user->createToken('mobile')->plainTextToken;

        $this->withToken($token)
            ->deleteJson("/api/v1/life-areas/{$lifeArea->id}")
            ->assertUnprocessable();
    }
}
