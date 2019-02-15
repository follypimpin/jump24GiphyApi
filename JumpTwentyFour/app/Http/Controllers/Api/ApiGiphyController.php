<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\GifModel\GifChunkFiveOO;
    use App\GifModel\GifChunkThouOO;
    use App\GifModel\GifTimeStamped;
    use Carbon\Carbon;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Repository\GiphyTypeMapperRepository;
    use App\Http\Requests\GiphyRequests\GiphyTypeRequest;
    use Illuminate\Support\Facades\Validator;
    use App\Http\Requests\GiphyRequests\GiphyPostSearchRequest;
    use Illuminate\Support\Facades\DB;
    
    
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
                if ($giphyRepository instanceof \Exception) {
                    return response()->json(['NotFound:' => $giphyRepository->getMessage()], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage()], 404);
            }
            
            try {
                $response = $giphyRepository->trending(25);
                if ($response instanceof \GuzzleHttp\Exception\ClientException) {
                    return response()->json(['NotFound:' => $response->getMessage()], 404);
                }
                
                return response()->shortSpanCacheResponse($response, 200, 3600);
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage()], 404);
            }
            
            
        }
        
        
        /** Returns Giphy Searching End point(Gifs || Stickers)
         *
         * @param GiphyPostSearchRequest $request
         *
         * @return JsonResponse
         */
        public function postSearch(GiphyPostSearchRequest $request): JsonResponse
        {
            $validated = Validator::make($request->all(), $request->rules(),
                $request->messages());
            if ($validated->fails()) {
                response()->json(['UnprocessableEntity:' => $request->messages()], 422);
            }
            $data = $validated->getData();
            $id = (int)$data['id'];
            $query = (string)$data['query'];
            try {
                $giphyRepository = GiphyTypeMapperRepository::makeFor($id);
                if ($giphyRepository instanceof \Exception) {
                    return response()->json(['NotFound:' => $giphyRepository->getMessage()], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage()], 404);
            }
            
            try {
                $response = $giphyRepository->search($query, 25);
                if ($response instanceof \GuzzleHttp\Exception\ClientException) {
                    return response()->json(['NotFound:' => $response->getMessage()], 404);
                }
                
                return response()->shortSpanCacheResponse($response, 200, 60);
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage(), 404]);
            }
            
            
        }
        
        
        /** Returns Giphy Random End point(Gifs || Stickers)
         *
         * @param GiphyPostSearchRequest $request
         *
         * @return JsonResponse
         */
        public function postRandom(GiphyPostSearchRequest $request): JsonResponse
        {
            $validated = Validator::make($request->all(), $request->rules(),
                $request->messages());
            if ($validated->fails()) {
                response()->json(['UnprocessableEntity:' => $request->messages()], 422);
            }
            $data = $validated->getData();
            $id = (int)$data['id'];
            $query = (string)$data['query'];
            try {
                $giphyRepository = GiphyTypeMapperRepository::makeFor($id);
                if ($giphyRepository instanceof \Exception) {
                    return response()->json(['NotFound:' => $giphyRepository->getMessage()], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage()], 404);
            }
            
            try {
                $response = $giphyRepository->random($query);
                if ($response instanceof \GuzzleHttp\Exception\ClientException) {
                    return response()->json(['NotFound:' => $response->getMessage()], 404);
                }
                
                return response()->json($response, 200);
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage(), 404]);
            }
        }
        
        
        /** Random API endpoint to fetch a large chunk of gif records(500)
         *
         * @param GiphyPostSearchRequest $request
         *
         * @return JsonResponse
         */
        public function fetchSearchRandom(GiphyPostSearchRequest $request): JsonResponse
        {
            $validated = Validator::make($request->all(), $request->rules(),
                $request->messages());
            if ($validated->fails()) {
                response()->json(['UnprocessableEntity:' => $request->messages()], 422);
            }
            $data = $validated->getData();
            $id = (int)$data['id'];
            $query = (string)$data['query'];
            try {
                $giphyRepository = GiphyTypeMapperRepository::makeFor($id);
                if ($giphyRepository instanceof \Exception) {
                    return response()->json(['NotFound:' => $giphyRepository->getMessage()], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage()], 404);
            }
            
            try {
                $response = $giphyRepository->search($query, 500);
                if ($response instanceof \GuzzleHttp\Exception\ClientException) {
                    return response()->json(['NotFound:' => $response->getMessage()], 404);
                }
                $data = $response->data;
                $result = [];
                $time_start = microtime(true);
                foreach ($data as &$d) {
                    $result [] = [
                        'gif_id'            => $d->id,
                        'trending_datetime' => $d->trending_datetime,
                        'embed_url'         => $d->embed_url,
                        'title'             => $d->title
                    ];
                }
                
                unset($d);
                $time_end = microtime(true);
                $execution_time = $time_end - $time_start;
                
                $chunks = collect($result)->chunk(200);
                foreach ($chunks as $chunk) {
                    //GifChunkFiveOO::create($chunk->toArray());
                    $db = DB::table('gif_five_hundy')->insert($chunk->toArray());
                }
                
                
                return response()->json($db, 200);
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage(), 404]);
            }
            
            
        }
        
        
        /** Random API endpoint to fetch a large chunk of gif records(1000)
         *
         * @param GiphyPostSearchRequest $request
         *
         * @return JsonResponse
         */
        public function fetchSearchThouRandom(GiphyPostSearchRequest $request): JsonResponse
        {
            $validated = Validator::make($request->all(), $request->rules(),
                $request->messages());
            if ($validated->fails()) {
                response()->json(['UnprocessableEntity:' => $request->messages()], 422);
            }
            $data = $validated->getData();
            $id = (int)$data['id'];
            $query = (string)$data['query'];
            try {
                $giphyRepository = GiphyTypeMapperRepository::makeFor($id);
                if ($giphyRepository instanceof \Exception) {
                    return response()->json(['NotFound:' => $giphyRepository->getMessage()], 404);
                }
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage()], 404);
            }
            
            try {
                $response = $giphyRepository->search($query, 1000);
                if ($response instanceof \GuzzleHttp\Exception\ClientException) {
                    return response()->json(['NotFound:' => $response->getMessage()], 404);
                }
                $data = $response->data;
                $result = [];
                $time_start = microtime(true);
                foreach ($data as &$d) {
                    $result [] = [
                        'gif_id'            => $d->id,
                        'trending_datetime' => $d->trending_datetime,
                        'embed_url'         => $d->embed_url,
                        'title'             => $d->title
                    ];
                }
                
                unset($d);
                $time_end = microtime(true);
                $execution_time = $time_end - $time_start;
                
                $chunks = collect($result)->chunk(500);
                $time_start_chunk = microtime(true);
                foreach ($chunks as $chunk) {
                    
                    $db = DB::table('gif_thou')->insert($chunk->toArray());
                    $time_end = microtime(true);
                }
                $execution_time_db = $time_end - $time_start_chunk;
                
                
                return response()->json([
                    'db_flag'             => $db,
                    'db_completion_time'  => $execution_time_db,
                    'data_execution_time' => $execution_time
                ], 200);
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage(), 404]);
            }
            
            
        }
        
        
        public function appendCursorTimeStamp(GiphyTypeRequest $request): JsonResponse
        {
            $validated = Validator::make($request->all(), $request->rules(),
                $request->messages());
            if ($validated->fails()) {
                response()->json(['UnprocessableEntity:' => $request->messages()], 422);
            }
            $data = $validated->getData();
            $id = $data['id'];
            $time_start = microtime(true);
            
            foreach (GifChunkFiveOO::where('migration_date', '>', '2019-02-15 01:29:41')->cursor() as $gifs) {
                $list = [];
                foreach ($gifs as $gif) {
                    $current_time = Carbon::now()->toDateTimeString();
                    $result = [
                        'gif_id'    => $gifs->gif_id,
                        'embed_url' => $gifs->embed_url,
                        'title'     => $gifs->title . $id . $current_time,
                    
                    ];
                    
                    $list[] = $result;// push data in to array
                }
                // perform an insert
                DB::table('gif_time_stamped')->insert($list);
                
            }
            
            $time_end = microtime(true);
            $execution_time_db = $time_end - $time_start;
            
            
            return response()->json([
                'db_flag'       => true,
                'time_start'    => $time_start,
                'time_end'      => $time_end,
                'db_completion' => $execution_time_db
            ], 200);
        }
        
        
        public function appendChunkTimeStap(GiphyTypeRequest $request): JsonResponse
        {
            $validated = Validator::make($request->all(), $request->rules(),
                $request->messages());
            if ($validated->fails()) {
                response()->json(['UnprocessableEntity:' => $request->messages()], 422);
            }
            $data = $validated->getData();
            $id = $data['id'];
            $time_start = microtime(true);
    
            $query = GifChunkThouOO::where('id', '!=', $id);
            $query->chunk(200, function ($gifs) {
                $list = [];
                foreach ($gifs as $item) {
                    $current_time = Carbon::now()->toDateTimeString();
                    $result = [
                        'gif_id'    => $item->gif_id,
                        'embed_url' => $item->embed_url,
                        'title'     => $item->title . $current_time,
                    
                    ];
                    
                    $list[] = $result;
                }
                
                DB::table('gif_time_stamped')->insert($list);
                
            });
            $time_end = microtime(true);
            $execution_time_db = $time_end - $time_start;
            
            return response()->json([
                'db_flag'       => true,
                'time_start'    => $time_start,
                'time_end'      => $time_end,
                'db_completion' => $execution_time_db
            ], 200);
        }
    
        /**
         * @param GiphyTypeRequest $request
         *
         * @return JsonResponse
         */
        public function chunkTest(GiphyTypeRequest $request): JsonResponse
        {
    
            $validated = Validator::make($request->all(), $request->rules(),
                $request->messages());
            if ($validated->fails()) {
                response()->json(['UnprocessableEntity:' => $request->messages()], 422);
            }
            $data = $validated->getData();
            $id = $data['id'];
            
            $query = GifChunkThouOO::where('id', '!=', 470);
            $queryCount = $query->count();
            $i = 0;
    
            $time_start = microtime(true);
            $query->chunk(100, function ($gifsthou) use ($queryCount, &$i) {
                $gifsthou->each(function ($thou) {
                    $query = GifChunkFiveOO::where('gif_id', $thou->gif_id);
                    
                    
                    if ($gifsfive = $query->get()->first()) {
                        $thou->gif_id = $gifsfive->id;
                        $thou->save();
                    }
                });
                
                $i += $gifsthou->count();
                
            });
            $time_end = microtime(true);
            $execution_time_db = $time_end - $time_start;
            
            return response()->json([
                'count' => $queryCount,
                'id' => $id,
                '$i'    => $i,
                'db_flag'       => true,
                'time_start'    => $time_start,
                'time_end'      => $time_end,
                'db_completion' => $execution_time_db
            ], 200);
        }
        
        
        /**
         * @param \stdClass $data
         * @param int       $chunk
         *
         * @return array
         */
        private function getGifData(\stdClass $data, int $chunk): array
        {
            $result = [];
            $time_start = microtime(true);
            foreach ($data as &$d) {
                $result [] = [
                    'gif_id'            => $d->id,
                    'trending_datetime' => $d->trending_datetime,
                    'embed_url'         => $d->embed_url,
                    'title'             => $d->title
                ];
            }
            unset($d);
            $time_end = microtime(true);
            $execution_time = $time_end - $time_start;
            $result[][] = [
                'time_start'     => $time_start,
                'time_end'       => $time_end,
                'execution_time' => $execution_time
            ];
            
            return $result;
        }
    }
