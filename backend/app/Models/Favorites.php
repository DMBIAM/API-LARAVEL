<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'employee_id'
    ];

    /**
     * Get the area that the employee belongs to.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
