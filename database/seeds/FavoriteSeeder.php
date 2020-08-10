<?php

use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Favorite::create([
            'name' => 'Monster Ultra Sunrise',
            'caffeine' => '150',
            'description' => 'A refreshing orange beverage that has 75mg of caffeine per serving. Every can has two servings.'
        ]);
        
        App\Favorite::create([
            'name' => 'Black Coffee',
            'caffeine' => '95',
            'description' => 'The classic, the average 8oz. serving of black coffee has 95mg of caffeine.'
        ]);
        
        App\Favorite::create([
            'name' => 'Americano',
            'caffeine' => '77',
            'description' => 'Sometimes you need to water it down a bit... and in comes the americano with an average of 77mg. of caffeine per serving.'
        ]);
        
        App\Favorite::create([
            'name' => 'Sugar free NOS',
            'caffeine' => '260',
            'description' => 'Another orange delight without the sugar. It has 130 mg. per serving and each can has two servings.'
        ]);
        
        App\Favorite::create([
            'name' => '5 Hour Energy',
            'caffeine' => '200',
            'description' => 'And amazing shot of get up and go! Each 2 fl. oz. container has 200mg of caffeine to get you going.'
        ]);

    }
}
