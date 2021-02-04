<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CustomerCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_can_register()
    {
        Storage::fake('avatars');

        $data = [
            'code' => 'CODE-123',
            'name' => 'Pedro Doe',
            'birthday' => '1990-08-26',
            'avatar' => UploadedFile::fake()->image('my-avatar.jpg')
        ];

        $response = $this->postJson('api/customers/register', $data);

        $response->assertCreated();

        unset($data['avatar']);

        $response->assertJson($data);
    }
}
