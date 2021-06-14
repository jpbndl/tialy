<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Slug;
use App\Http\Requests\SlugRequest;
use Illuminate\Support\Facades\Event;

class SlugTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private function data() {
        return [
            'slug' => '1a',
            'redirect' => 'https://www.techinasia.com/car-rental-startup-smove'
        ];
    }

    /** @test */
    public function it_should_forbid_an_unauthenticated_user_to_get_the_slug_list() {
        $response = $this->json('GET', 'api/slug')->assertStatus(401);
    }

    /** @test */
    public function it_should_forbid_an_unauthenticated_user_to_create_a_slug() {
        $response = $this->json('POST', 'api/slug', $this->data())->assertStatus(401);
    }

    /** @test */  
    public function it_should_forbid_an_unauthenticated_user_to_update_a_slug() {
        $response = $this->json('PUT', 'api/slug/1', $this->data())->assertStatus(401);
    }

    /** @test */
    public function it_should_fail_validation_if_slug_is_not_provided() {
        $this->actingAs(factory(User::class)->create(), 'api');

        $response = $this->json('POST', '/api/slug', ['redirect' => 'https://www.techinasia.com/car-rental-startup-smove'])->assertStatus(422);
    }
}
