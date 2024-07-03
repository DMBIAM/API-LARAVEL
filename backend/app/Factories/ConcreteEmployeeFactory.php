<?php 

namespace App\Factories;

use App\Models\Employee;

class ConcreteEmployeeFactory extends EmployeeFactory
{
    /**
     *
     *
     * @param array $attributes
     * @return Employee
     */
    public function create(array $attributes): Employee
    {
        // TODO validaciones de datos.
        return parent::create($attributes);
    }
}