<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use WithFaker;

    /**
     * A basic registration.
     *
     * @return void
     */
    public function testsRegistersSuccessfully()
    {
        $payload =  [
            "name" => "Direct Ad Network",
            "address1" => "Rock Heven Way",
            "address2" => "#125",
            "city" => "Sterling",
            "state" => "VA",
            "country" => "USA",
            "zip" => "20166",
            "phoneNo1" => "555-666-7777",
            "phoneNo2" => "",
            "user" => [
                    "firstName" => "John",
                    "lastName" => "Doe",
                    "email" => $this->faker->email,
                    "password" => "Secret@123",
                    "passwordConfirmation" => "Secret@123",
                    "phone" => "123-456-7890"
                ]
            ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(201);
    }

    public function testsRegistrationFail()
    {
        $this->json('post', '/api/register')
            ->assertStatus(422);
    }
}
