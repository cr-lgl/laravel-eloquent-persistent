<?php

namespace Unit\Models;

use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_not_save_users_call_only_once(): void
    {
        $store = new Store();
        $store->users->push(User::factory()->makeOne());
        $store->save();
        $store->refresh();

        $this->assertFalse($store->users->isNotEmpty());
    }

    /**
     * @test
     */
    public function can_save_users(): void
    {
        $store = new Store();
        $store->save();
        $store->users()->save(User::factory()->makeOne());
        $store->refresh();

        $this->assertTrue($store->users->isNotEmpty());
    }
}
