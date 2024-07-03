<?php

namespace Tests\Unit;

use App\Models\Area;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AreaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */    
    /**
     * test_area_creation
     * 
     * Create Area
     *
     * @return void
     */
    public function test_area_creation()
    {
        Area::factory()->create([
            'name' => 'Test Area',
        ]);

        $this->assertDatabaseHas('areas', [
            'name' => 'Test Area',
        ]);  
        
        $response = $this->get('/api/v1/areas');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => 'Test Area',
        ]);
    }
    
}
