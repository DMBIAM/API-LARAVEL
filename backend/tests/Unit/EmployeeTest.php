<?php

namespace Tests\Unit;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    //use RefreshDatabase;

    /** @test */    
    /**
     * test_employee_creation
     * 
     * Create Employee
     *
     * @return void
     */
    public function test_employee_creation()
    {
        $employee = Employee::factory()->create([
            'name' => 'John',
            'lastname' => 'Doe',
            'date' => '1990-01-01',
            'mail' => 'john.doe@example.com',
            'area_id' => 1,
            'category_id' => 1,
            'company_id' => 1,
            'city_id' => 1,
            'satisfaction' => 80,
        ]);

        $this->assertInstanceOf(Employee::class, $employee);
        $this->assertEquals('John', $employee->name);
        $this->assertEquals('Doe', $employee->lastname);
        $this->assertEquals('1990-01-01', $employee->date);
        $this->assertEquals('john.doe@example.com', $employee->mail);
        $this->assertEquals(2, $employee->area_id);
        $this->assertEquals(1, $employee->category_id);
        $this->assertEquals(1, $employee->company_id);
        $this->assertEquals(1, $employee->city_id);
        $this->assertEquals(80, $employee->satisfaction);
    }  
    
}
