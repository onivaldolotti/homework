<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class SaleControllerTest extends TestCase
{
    public function test_store_should_return_error_when_not_enough_params()
    {
        $response = $this->post('api/sales', ["sellers_id" => 1]);

        $response->assertStatus(302);
    }

    public function test_store_should_return_success_when_correct_params()
    {
        $response = $this->post('api/sales', ["seller_id" => 1, "value"=> 100]);

        $response->assertStatus(201);
    }

    public function test_store_should_create_a_new_sale()
    {
        $response = $this->post('api/sales', ["seller_id" => 1, "value"=> 100]);

        $response->assertJson([
            "data"=>[
                'value' => 100,
                'commission' => "8.50"
            ]
        ]);

        $this->assertTrue($response['success']);
    }

    public function test_listBySellerId_should_return_error_when_not_find_seller()
    {
        $response = $this->get('api/sales/9999');

        $response->assertStatus(302);
    }

    public function test_listBySellerId_should_list_sales()
    {
        $response = $this->get('api/sales/1');

        $response->assertStatus(200);

        $this->assertTrue($response['success']);
    }
}
