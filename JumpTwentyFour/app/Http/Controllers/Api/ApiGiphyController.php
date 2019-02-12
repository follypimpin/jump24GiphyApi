<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GiphyApi\Types\Gif;
use App\Repository\GiphyTypeMapperRepository;
use App\Http\Requests\GiphyRequests\GiphyTypeRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\GiphyRequests\GiphyPostSearchRequest;



class ApiGiphyController extends Controller
{
    
    
    /** Returns Giphy Trending End point(Gifs || Stickers)
     * @param GiphyTypeRequest $request
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function getTrending(GiphyTypeRequest $request): JsonResponse
    {
    
        $validated = Validator::make($request->all(), $request->rules(),
            $request->messages());
        if ($validated->fails()) {
            response()->json(['UnprocessableEntity:' => $request->messages()], 422);
        }
          $id = (int)$request->id;
          $giphyRepository = GiphyTypeMapperRepository::makeFor($id);
          try{
              $response = $giphyRepository->trending(25);
          } catch (\Exception $e){
              return response()->json(['NotFound:' => $e->getMessage(),404]);
          }
        
          return response()->shortSpanCacheResponse($response,200);
          
    }
    
    
    public function postSearch(GiphyPostSearchRequest $request)
    {
        $validated = Validator::make($request->all(), $request->rules(),
            $request->messages());
        if ($validated->fails()) {
            response()->json(['UnprocessableEntity:' => $request->messages()], 422);
        }
        $data = $validated->getData();
        $id =(int)$data['id'];
        $query = (string)$data['query'];
       /* $id = (int)$request->id;
        $query = $request->query;
        $query = (string)$query;*/
        $giphyRepository = GiphyTypeMapperRepository::makeFor($id);
        try{
            $response = $giphyRepository->search($query,25);
        } catch (\Exception $e){
            return response()->json(['NotFound:' => $e->getMessage(),404]);
        }
        return response()->json($response,200);
    }
}
