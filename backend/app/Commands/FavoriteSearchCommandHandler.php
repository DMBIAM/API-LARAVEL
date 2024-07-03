<?php

namespace App\Commands;

use App\Models\Favorites;

/**
 * FavoriteSearchCommandHandler
 */
class FavoriteSearchCommandHandler implements CommandInterface
{    
    
    /**
     * execute
     *
     * @param  array $params
     * @return array
     */
    public function execute(array $params = []) {
        $query = Favorites::query()
            ->join('employees', 'favorites.employee_id', '=', 'employees.id')
            ->leftJoin('areas', 'employees.area_id', '=', 'areas.id')
            ->leftJoin('categories', 'employees.category_id', '=', 'categories.id')
            ->leftJoin('companies', 'employees.company_id', '=', 'companies.id')
            ->leftJoin('cities', 'employees.city_id', '=', 'cities.id')
            ->select(
                'favorites.*'
            );
        
        if (isset($params['employee'])) {
            $query->where('employees.name', 'like', '%' . $params['employee'] . '%');
        }

        if (isset($params['company'])) {
            $query->where('employees.company_id', $params['company']);
        }

        if (isset($params['category'])) {
            $query->where('employees.category_id', $params['category']);
        }

        return $query->with('employee.area', 'employee.category', 'employee.company', 'employee.city')->get();
    }

}
