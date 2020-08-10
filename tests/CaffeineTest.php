<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CaffeineTest extends TestCase
{
    /**
     * Test Favorite Drinks API
     *
     * @return void
     */
    public function testGettingFavoriteDrinks()
    {
        $this->get('/api/v1/favorite', ['Authorization' => 'Basic ZGVtbzpEZW1vQDEyMw==']);

        $this->response->assertStatus(200);
        
        $response = json_decode($this->response->getContent(),true);
        $this->assertTrue($response['success']);
        $this->assertEquals(5, count($response['data']));
        $this->response->assertJsonStructure(
                [
                    'success',
                    'status',
                    'message',
                    'data' =>
                        [
                                [
                                    'id',
                                    'name',
                                    'caffeine',
                                    'description',
                                    'created_at',
                                    'updated_at'
                                ]
                        ]
                ]
            );
    }
    
    /**
     * Test Available Limit API
     *
     * @return void
     */
    public function testAllReturnedOptionsAreUnderSafeLimit()
    {
        $this->get('/api/v1/availablelimit/2/1', ['Authorization' => 'Basic ZGVtbzpEZW1vQDEyMw==']);

        $this->response->assertStatus(200);
        
        $response = json_decode($this->response->getContent(),true);
        
        $this->assertTrue($response['success']);
        
        for( $i=0; $i<count($response['data']); $i++) {
            $caffeine = 0;
         
            for( $j=0; $j<count($response['data'][$i]); $j++) {
                $caffeine += ($response['data'][$i][$j]['caffeine']);
            }
            $this->assertTrue($caffeine <= config('extra_config.safe_limit'));
        }
    }
}
