<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountTest extends TestCase
{
    public function testsAccount()
    {
        $this->json('get', '/api/account')
            ->assertStatus(200);
    }
}
