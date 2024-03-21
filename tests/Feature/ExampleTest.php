<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function dealer(): void
    {
        $response = $this->get('/dealer-pulsa');

        $response->assertStatus(200);
    }
    public function biller(): void
    {
        $response = $this->get('/biller-pulsa');

        $response->assertStatus(200);
    }
    public function adminaproval(): void
    {
        $response = $this->get('/approved-dealer-pulsa');

        $response->assertStatus(200);
    }
}
