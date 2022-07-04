<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Support\Str;

class SellerControllerTest extends TestCase
{
    public function test_store_should_return_error_when_not_enough_params()
    {
        $response = $this->post('api/sellers');

        $response->assertStatus(302);
    }

    public function test_store_should_return_error_when_invalid_email()
    {
        $response = $this->post('api/sellers',["name" => "joao", "email" => "email invalido"]);

        $response->assertStatus(302);
    }

    public function test_store_should_create_a_new_seller()
    {
        $name = Str::random(30);
        $email = Str::random(10).'@'.Str::random(10).'com';
        $response = $this->post('api/sellers', ["name" => $name, "email"=> $email]);

        $response->assertJson([
            "data"=>[
                'name' => $name,
                'email' => $email,
                'commission' => "0,00"
            ]
        ])->assertStatus(201);

        $this->assertTrue($response['success']);
    }

    public function test_index_should_return_a_list_of_sellers()
    {
        $response = $this->get('api/sellers');

        $response->assertStatus(200);

        $this->assertTrue($response['success']);
    }
}
