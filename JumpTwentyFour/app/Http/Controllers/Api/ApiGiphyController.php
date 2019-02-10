<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GiphyApi\Types\Gif;
use App\Repository\GiphyTypeMapperRepository;
use App\Http\Requests\GiphyRequests\GiphyTypeRequest;
use Illuminate\Support\Facades\Validator;



class ApiGiphyController extends Controller
{
    //
    
    public function getTrending(GiphyTypeRequest $request): JsonResponse
    {
    
        $validated = Validator::make($request->all(), $request->rules(),
            $request->messages());
        if ($validated->fails()) {
            response()->json(['UnprocessableEntity:' => $request->messages()], 422);
        }
          $id = $request->id;
          $id = (int)$id;
          $giphyRepository = GiphyTypeMapperRepository::makeFor($id);
          try{
              
              $response = $giphyRepository->trending(25);
          } catch (\Exception $e){
              return $e->getMessage();
          }
          return response()->json($response,200);
          
    }
}
