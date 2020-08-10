<?php

namespace App\Repositories;

use App\Favorite;
use App\Interfaces\FavoriteRepositoryInterface;

class FavoriteRepository implements FavoriteRepositoryInterface {
    protected $model;
    
    /**
     * FavoriteRepository constructor.
     * @param Favorite $favorite
     */
    public function __construct(Favorite $favorite)
    {
        $this->model = $favorite;
    }
    
    public function get() {
        try {
            if(app('redis')->exists('favoritedrink')) {
                return json_decode(app('redis')->get('favoritedrink'),true);
            } 
        } catch(\RedisException $exception){
            
        }
        $favorites = $this->model->all()->toArray();
        
        try {
            app('redis')->set('favoritedrink', json_encode($favorites));
        } catch(\RedisException $exception){
            
        }
        
        return $favorites;
    }
}
