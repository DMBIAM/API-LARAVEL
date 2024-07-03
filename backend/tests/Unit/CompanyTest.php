<?php

namespace Tests\Unit;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */    
    /**
     * test_company_creation
     * 
     * Create company
     *
     * @return void
     */
    public function test_company_creation()
    {
        // Create Company
        Company::factory()->create([
            'name' => 'Test Company',
        ]);

        $this->assertDatabaseHas('companies', [
            'name' => 'Test Company',
        ]);  
        
        $response = $this->get('/api/v1/companies');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => 'Test Company',
        ]);
    }
    
}
