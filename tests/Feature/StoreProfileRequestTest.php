<?php

namespace Tests\Feature;

use App\Http\Requests\StoreProfileRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreProfileRequestTest extends TestCase
{
    public function test_profile_rules_first_name(): void
    {
        $request = new StoreProfileRequest();
        $rules = $request->rules();
        $this->assertContains('string', $rules['first_name']);
        $this->assertContains('required', $rules['first_name']);
    }

    public function test_profile_rules_last_name(): void
    {
        $request = new StoreProfileRequest();
        $rules = $request->rules();
        $this->assertContains('string', $rules['last_name']);
        $this->assertContains('required', $rules['last_name']);
    }
    public function test_profile_rules_image(): void
    {
        $request = new StoreProfileRequest();
        $rules = $request->rules();
        $this->assertContains('image', $rules['image']);
        $this->assertContains('mimes:jpeg,png,jpg', $rules['image']);
    }

    public function test_profile_rules_status(): void
    {
        $request = new StoreProfileRequest();
        $rules = $request->rules();
        $this->assertContains('string', $rules['status']);
        $this->assertContains('required', $rules['status']);
    }
}
