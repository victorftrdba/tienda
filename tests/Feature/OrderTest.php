<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function testStoreOrder()
    {
        $this->actingAs($this->user);

        $data = Order::factory()->makeOne()->toArray();

        $response = $this->postJson('/api/orders', $data)->assertCreated();

        $this->assertDatabaseHas('orders', [
            'id' => data_get($response->getData(), 'id')
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
}
