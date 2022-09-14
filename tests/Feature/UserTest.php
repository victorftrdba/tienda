<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testAuth()
    {
        $user = User::factory()->create()->toArray();

        $this->postJson('/api/auth', [...$user, 'password' => '123456'])->assertOk();
    }

    public function testRegisterUser()
    {
        $data = User::factory()->makeOne()->toArray();

        $this->postJson('/api/register', $data)->assertCreated();
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }
}
