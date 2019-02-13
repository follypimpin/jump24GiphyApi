<?php
    
    namespace App\Http\Controllers\Api;
    
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Repository\GiphyTypeMapperRepository;
    use App\Http\Requests\GiphyRequests\GiphyTypeRequest;
    use Illuminate\Support\Facades\Validator;
    use App\Http\Requests\GiphyRequests\GiphyPostSearchRequest;
    
    
    class ApiGiphyController extends Controller
    {
        
        
        /** Returns Giphy Trending End point(Gifs || Stickers)
         *
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
            $data = $validated->getData();
            $id = $data['id'];
            //$id = (int)$request->id;
            try {
                $giphyRepository = GiphyTypeMapperRepository::makeFor((int)$id);
                if($giphyRepository instanceof \Exception){
                    return response()->json(['NotFound:' => $giphyRepository->getMessage()], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage()], 404);
            }
            
            try {
                $response = $giphyRepository->trending(25);
                if($response instanceof \GuzzleHttp\Exception\ClientException){
                    return response()->json(['NotFound:' => $response->getMessage()], 404);
                }
                return response()->shortSpanCacheResponse($response, 200,3600);
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage()], 404);
            }
            
            
            
        }
    
    
        /** Returns Giphy Searching End point(Gifs || Stickers)
         * @param GiphyPostSearchRequest $request
         *
         * @return JsonResponse
         */
        public function postSearch(GiphyPostSearchRequest $request)
        {
            $validated = Validator::make($request->all(), $request->rules(),
                $request->messages());
            if ($validated->fails()) {
                response()->json(['UnprocessableEntity:' => $request->messages()], 422);
            }
            $data = $validated->getData();
            $id = (int)$data['id'];
            $query = (string)$data['query'];
            try{
                $giphyRepository = GiphyTypeMapperRepository::makeFor($id);
                if($giphyRepository instanceof \Exception){
                    return response()->json(['NotFound:' => $giphyRepository->getMessage()], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage()], 404);
            }
            
            try {
                $response = $giphyRepository->search($query, 25);
                if($response instanceof \GuzzleHttp\Exception\ClientException){
                    return response()->json(['NotFound:' => $response->getMessage()], 404);
                }
                return response()->shortSpanCacheResponse($response, 200,60);
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage(), 404]);
            }
            
           
        }
    }
