<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GiphyApi\Types\Gif;
use App\Repository\GiphyTypeMapperRepository;



class ApiGiphyController extends Controller
{
    //
    
    public function getTrending(Request $request): JsonResponse
    {
       
          $id = $request->id;
          $id = (int)$id;
          $giphyRepository = GiphyTypeMapperRepository::makeFor($id);
          try{
              
              $response = $giphyRepository->trending(20);
          } catch (\Exception $e){
              return $e->getMessage();
          }
          return response()->json($response,200);
          
    }
}
