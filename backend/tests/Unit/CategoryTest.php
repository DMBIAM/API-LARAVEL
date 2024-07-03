<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */    
    /**
     * test_category_creation
     * 
     * Create Category
     *
     * @return void
     */
    public function test_category_creation()
    {
        Category::factory()->create([
            'name' => 'Test Category',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
        ]);  
        
        $response = $this->get('/api/v1/categories');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => 'Test Category',
        ]);
    }
    
}
