<?php

namespace App\Commands;

use App\Models\Favorites;

/**
 * DeleteFavoriteCommand
 */
class DeleteFavoriteCommand implements CommandInterface
{
    private $favoriteId;
    
    /**
     * __construct
     *
     * @param  int $favoriteId
     * @return void
     */
    public function __construct(int $favoriteId)
    {
        $this->favoriteId = $favoriteId;
    }
    
    /**
     * execute
     *
     * @return void
     */
    public function execute(array $params = [])
    {
        $favorite = Favorites::findOrFail($this->favoriteId);
        $favorite->delete();
        return $favorite;
    }
}