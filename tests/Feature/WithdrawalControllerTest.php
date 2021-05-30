<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WithdrawalControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_that_the_system_can_show_customer_infomation() 
    {
        $response = $this->get('/show-withdrawal/{id}');

        $response->assertSee('withdrawal');
    }
    public function test_that_the_system_return_list_of_customers()
    {
        $response = $this->get('/withdrawals');

        $response->assertStatus(200);
    }
    public function test_customer_index_page_has_customer_data()
    {
        $response = $this->post('/withdrawals');

        // $response->assertStatus(401);
        $response->assertSee('withdrawal');
    }
}
