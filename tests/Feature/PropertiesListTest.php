<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertiesListTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::find(2);

//        $response = $this->actingAs($user)->get('/submit-property/submit');
//
//        $response->assertStatus(200);
        $response = $this->actingAs($user)->call('POST', '/submit-property/submit-prop', array(
            '_token' => csrf_token(),
        ));
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertRedirectedTo('questions');
    }
}
