<?php
    
    namespace App\Http\Controllers\Api;
    
    use App\GifModel\GifChunkFiveOO;
    use App\GifModel\GifChunkThouOO;
    use App\GifModel\GifTimeStamped;
    use App\Http\Requests\GiphyRequests\GiphySearchLatestRequest;
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
        
        
        /** Random API endpoint to fetch a large chunk of gif records(500) & inserts into DB
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
                
                foreach ($data as &$d) {
                    $result [] = [
                        'gif_id'            => $d->id,
                        'trending_datetime' => $d->trending_datetime,
                        'embed_url'         => $d->embed_url,
                        'title'             => $d->title
                    ];
                }
                
                unset($d);
                
                $chunks = collect($result)->chunk(200);
                $start_time = microtime(true);
                foreach ($chunks as &$chunk) {
                    $db = DB::table('gif_five_hundy')->insert($chunk->toArray());
                }
                unset($chunk);
                $completeDb = microtime(true) - $start_time;
                
                
                return response()->json([
                    'db_flag'            => $db,
                    'db_completion_time' => $completeDb
                ]);
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
                
                foreach ($data as &$d) {
                    $result [] = [
                        'gif_id'            => $d->id,
                        'trending_datetime' => $d->trending_datetime,
                        'embed_url'         => $d->embed_url,
                        'title'             => $d->title
                    ];
                }
                
                unset($d);
                
                
                $chunks = collect($result)->chunk(200);
                $time_start = microtime(true);
                foreach ($chunks as &$chunk) {
                    
                    $db = DB::table('gif_thou')->insert($chunk->toArray());
                    
                }
                unset($chunk);
                $execution_time = microtime(true) - $time_start;
                $memory = memory_get_peak_usage(true) / 1024 / 1024;
                
                return response()->json([
                    'db_flag'            => $db,
                    'db_completion_time' => $execution_time,
                    'memory-usage'       => $memory
                ]);
            } catch (\Exception $e) {
                return response()->json(['NotFound:' => $e->getMessage(), 404]);
            }
            
            
        }
        
        
        /** Appends Current time stamp to gif titles and inserts into DB (Using Cursor)
         *
         * @param GiphyTypeRequest $request
         *
         * @return JsonResponse
         */
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
            $lists = [];
            $query = GifChunkThouOO::whereBetween('migration_date',
                array('2019-02-13 07:00:00', '2019-02-19 23:00:00'));
            foreach ($query->cursor() as $gifs) {
                $current_time = Carbon::now()->toDateTimeString();
                // push data in to array
                $lists[] = [
                    'gif_id'     => $gifs['gif_id'],
                    'embed_url'  => $gifs['embed_url'],
                    'title'      => $gifs['title'] . $id . $current_time,
                    'updated_at' => $current_time
                
                ];
                
                
            }
            // perform an insert
            $db = DB::table('gif_time_stamped')->insert($lists);
            
            $execution_time_db = microtime(true) - $time_start;
            $memory = memory_get_peak_usage(true) / 1024 / 1024;
            
            
            return response()->json([
                'db_flag'       => true,
                'db_completion' => $execution_time_db,
                'result'        => $db,
                'memory-usage'  => $memory
            
            ]);
        }
        
        
        /** Appends Current time stamp to gif titles and inserts into DB (Using Chunk)
         *
         * @param GiphyTypeRequest $request
         *
         * @return JsonResponse
         */
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
            
            $query = GifChunkThouOO::whereBetween('migration_date',
                array('2019-02-13 07:00:00', '2019-02-19 23:00:00'));
            // to add ->orderBy('migration_date')
            $query->chunk(200, function ($gifs) {
                $list = [];
                foreach ($gifs as $item) {
                    $current_time = Carbon::now()->toDateTimeString();
                    $result = [
                        'gif_id'     => $item->gif_id,
                        'embed_url'  => $item->embed_url,
                        'title'      => $item->title . $current_time,
                        'created_at' => $current_time
                    
                    ];
                    
                    $list[] = $result;
                }
                
                DB::table('gif_time_stamped')->insert($list);
                
            });
            $memory = memory_get_peak_usage(true) / 1024 / 1024;
            
            $execution_time_db = microtime(true) - $time_start;
            
            
            return response()->json([
                'db_flag'       => true,
                'db_completion' => $execution_time_db,
                'memory_usage'  => $memory
            ]);
        }
        
        
        /** Gets time stamped Gifs based on migration date (Using Cursor)
         *
         * @param GiphySearchLatestRequest $request
         *
         * @return JsonResponse
         */
        public function searchLatestCursor(GiphySearchLatestRequest $request): JsonResponse
        {
            $validated = Validator::make($request->all(), $request->rules(),
                $request->messages());
            if ($validated->fails()) {
                response()->json(['UnprocessableEntity:' => $request->messages()], 422);
            }
            $data = $validated->getData();
            $query = GifTimeStamped::whereBetween('migration_date',
                array($data['start_date'], $data['end_date']));
            $lists = [];
            $time_start = microtime(true);
            foreach ($query->cursor() as $gifs) {
                /* $current_time = Carbon::now()->toDateTimeString();*/
                // push data in to array
                $lists[] = [
                    'gif_id'    => $gifs['gif_id'],
                    'embed_url' => $gifs['embed_url'],
                    'title'     => $gifs['title']
                
                
                ];
                
                
            }
            $execution_time = microtime(true) - $time_start;
            
            $memory = memory_get_peak_usage(true) / 1024 / 1024;
            
            return response()->json([
                'stampedCursorList' => $lists,
                'db_completion'     => $execution_time,
                'memory_usage'      => $memory
            ]);
        }
        
        
        /** Gets time stamped Gifs based on migration date
         *
         * @param GiphySearchLatestRequest $request
         *
         * @return JsonResponse
         */
        public function searchLatestNonCursor(GiphySearchLatestRequest $request): JsonResponse
        {
            $validated = Validator::make($request->all(), $request->rules(),
                $request->messages());
            if ($validated->fails()) {
                response()->json(['UnprocessableEntity:' => $request->messages()], 422);
            }
            $data = $validated->getData();
        
            $time_start = microtime(true);
            $lists = GifTimeStamped::getMigratedRange($data['start_date'], $data['end_date']);
            $execution_time = microtime(true) - $time_start;
            $memory = memory_get_peak_usage(true) / 1024 / 1024;
    
            return response()->json([
                'stampedChunkList' => $lists,
                'db_completion'    => $execution_time,
                'memory_usage'     => $memory
            ]);
            
            
            
        }
    
    
        /** Gets time stamped Gifs based on migration date
         *
         * @param GiphySearchLatestRequest $request
         *
         * @return JsonResponse
         */
        public function searchPaginated(GiphySearchLatestRequest $request): JsonResponse
        {
            $validated = Validator::make($request->all(), $request->rules(),
                $request->messages());
            if ($validated->fails()) {
                response()->json(['UnprocessableEntity:' => $request->messages()], 422);
            }
            $data = $validated->getData();
        
            $time_start = microtime(true);
            $lists = GifTimeStamped::getMigratedPaginateRange($data['start_date'], $data['end_date']);
            $execution_time = microtime(true) - $time_start;
            $memory = memory_get_peak_usage(true) / 1024 / 1024;
        
            return response()->json([
                'stampedChunkList' => $lists,
                'db_completion'    => $execution_time,
                'memory_usage'     => $memory
            ]);
        
        
        
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
        
        
        // ToDo: Want to explore this below for multiple table (future stuff)
        
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
                'count'         => $queryCount,
                'id'            => $id,
                '$i'            => $i,
                'db_flag'       => true,
                'time_start'    => $time_start,
                'time_end'      => $time_end,
                'db_completion' => $execution_time_db
            ], 200);
        }
    }
