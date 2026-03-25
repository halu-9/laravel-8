<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    public function testStatusCode() : void {
        // \Illuminate\Testing\TestResponseが返る
        $response = $this->get("/home");
        $response->assertStatus(200);
    }

    public function testBody() : void {
        $response = $this->get("/home");
        $response->assertSeeText("こんにちは!");
    }
}
