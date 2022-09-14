<?php

namespace Tests\Unit\Services;

use App\Http\Services\PlaceToPayService;
use App\Models\Order;
use App\Models\User;
use Tests\TestCase;

class PlaceToPlayTest extends TestCase
{
    public function testCreateSession()
    {
        $data = Order::factory()->makeOne()->toArray();
        $user = User::factory()->create();

        $this->assertIsArray($this->service->createSession($data, $user));
    }

    public function testGetSessionByRequestId()
    {
        $data = Order::factory()->makeOne()->toArray();
        $user = User::factory()->create();

        $this->assertIsString(data_get($this->service->createSession($data, $user), 'url'));
        $this->assertStringContainsString('checkout-co', data_get($this->service->createSession($data, $user), 'url'));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PlaceToPayService();
    }
}
