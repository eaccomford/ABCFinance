<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepositControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_that_the_system_can_show_customer_infomation() 
    {
        $response = $this->get('/show-deposit/{id}');

        $response->assertSee('deposits');
    }
    public function test_that_the_system_return_list_of_customers()
    {
        $response = $this->get('/deposits');

        $response->assertStatus(200);
    }
    public function test_customer_index_page_has_customer_data()
    {
        $response = $this->post('/deposits');

        // $response->assertStatus(401);
        $response->assertSee('deposit');
    }
}
