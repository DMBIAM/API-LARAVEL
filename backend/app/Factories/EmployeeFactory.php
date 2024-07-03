<?php
// backend/app/Factories/EmployeeFactory.php

namespace App\Factories;

use App\Models\Employee;

abstract class EmployeeFactory implements EmployeeFactoryInterface
{
    /**
     *
     *
     * @param array $attributes
     * @return Employee
     */
    public function create(array $attributes): Employee
    {
        return Employee::create($attributes);
    }
}
