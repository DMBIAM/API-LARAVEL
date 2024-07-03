<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Employee
 */
class Employee extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'date',
        'mail',
        'area_id',
        'category_id',
        'company_id',
        'city_id',
        'satisfaction',
    ];

    /**
     * Get the area that the employee belongs to.
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Get the category of the employee.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the company that the employee belongs to.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the city where the employee resides.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
