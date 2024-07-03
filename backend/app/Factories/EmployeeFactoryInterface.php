<?php 

namespace App\Factories;

use App\Models\Employee;

interface EmployeeFactoryInterface
{
    public function create(array $attributes): Employee;
}