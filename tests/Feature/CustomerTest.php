<?php

namespace Tests\Feature;

use App\Http\Resources\Customers;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_see_list_customers()
    {
        $user = $this->singInApi();

        $customer = Customer::factory()->count(10)->create();

        $response = $this->getJson('api/customers');

        $resource = Customers::collection($customer)
            ->response()->getData(true);

        $response->assertSuccessful();

        $response->assertJson($resource);
    }

    public function test_a_user_can_see_details_customer()
    {
        $user = $this->singInApi();

        $customer = Customer::factory()->create();

        $resource = Customers::make($customer)->response()->getData(true);

        $response = $this->getJson("api/customers/$customer->id");

        $response->assertSuccessful();

        $response->assertJson($resource);
    }

    public function test_a_user_can_update_info_of_customer()
    {
        $user = $this->singInApi();

        $customer = Customer::factory()->create();

        $data = [
            'code' => 'CODE-123',
            'name' => 'Pedro Doe',
            'birthday' => '1990-08-26',
        ];

        $response = $this->putJson("api/customers/$customer->id", $data);

        $response->assertStatus(201);

        $response->assertJson($data);
    }
}
