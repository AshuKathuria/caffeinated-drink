<?php

namespace App\Http\Controllers;
use App\Interfaces\FavoriteRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class DrinkController extends Controller
{
    private $favoriteRepo;
     
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FavoriteRepositoryInterface $favoriteRepository)
    {
         $this->favoriteRepo = $favoriteRepository;
    }

    /**
     * Get All Favorite Drinks
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $favorites = $this->favoriteRepo->get();
      
        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Favorite Drinks List',
            'data' => $favorites
        ]);
    }
     
    /**
     * Get Available Options
     * @param Integer $id
     * @param Integer $qty
     * @return \Illuminate\Http\JsonResponse
     */
    public function availableoptions($id, $qty)
    {
        $validator = Validator::make(['id'=>$id, 'qty'=>$qty], [
            'id' => 'required|integer|',
            'qty' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => $validator->errors()
            ], 400);
        }

        $favorites = $this->favoriteRepo->get();
        $drink = [];         
        $caffeineArray = [];
        
        foreach ($favorites as $item) {
             if ($item['id'] == $id){ $drink = $item;}
             $caffeineArray[] = ['caffeine' => $item['caffeine'],'name' => $item['name']];
        }
        
        if (empty($drink)) {
            return response()->json([
                'success' => false,
                'status' => 400,
                'message' => "Please select correct drink!"
            ], 400);
        }
        
        $safeLimit = config('extra_config.safe_limit');
        
        if (($drink['caffeine'] * $qty) > $safeLimit) {
            return response()->json([
                'success' => false,
                'status' => 200,
                'message' => "Safe Limit already crossed!"
            ]);
        }
        
        $sol = (new \Helper())->getAllPossibleCombinations($caffeineArray, $safeLimit - ($drink['caffeine'] * $qty));

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Available Options',
            'data' => $sol
        ]);
    }
     
}
