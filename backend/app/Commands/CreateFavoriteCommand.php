<?php

namespace App\Commands;

use App\Models\Favorites;

/**
 * CreateFavoriteCommand
 */
class CreateFavoriteCommand implements CommandInterface
{    
    /**
     * attributes
     *
     * @var mixed
     */
    private $attributes;
    
    /**
     * __construct
     *
     * @param  mixed $attributes
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }
    
    /**
     * execute
     *
     * @return void
     */
    public function execute(array $params = [])
    {
        return Favorites::create($this->attributes);
    }
}