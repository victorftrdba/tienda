<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testGetProducts()
    {
        $this->actingAs($this->user);

        $response = $this->getJson('/api/products')->assertOk();

        $this->assertObjectHasAttribute('data', $response->getData());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
}
