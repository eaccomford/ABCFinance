<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example() 
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_that_new_customer_is_created()
    {
        $response = $this->post('/new-account');

        // $response->assertStatus(401);
        $response->assertSee('love');
    }
    public function test_customer_index_page_has_customer_data()
    {
        $response = $this->post('/customers');

        // $response->assertStatus(401);
        $response->assertSee('customers');
    }
    
}
