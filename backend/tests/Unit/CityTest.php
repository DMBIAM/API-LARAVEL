<?php

namespace Tests\Unit;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */    
    /**
     * test_city_creation
     * 
     * Create city
     *
     * @return void
     */
    public function test_city_creation()
    {
        // Create City
        City::factory()->create([
            'name' => 'Test City',
        ]);

        $this->assertDatabaseHas('cities', [
            'name' => 'Test City',
        ]);  
        
        $response = $this->get('/api/v1/cities');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => 'Test City',
        ]);
    }
    
}
