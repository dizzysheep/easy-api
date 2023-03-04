<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get("/api/v1/home");
        $response
            ->assertStatus(200)
            ->assertJson(
                [
                    'name' => 'zhangsan',
                    'age' => true
                ]
            );
    }
}
